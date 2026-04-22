<?php

/**
 * Клас IssiSendMessage отговаря за изпращането на заявката
 * към системата на ИССИ. Класа съдържа статичен метод за извикване на
 * инстанция на самия клас. Това е с цел предотвратяване на създаването на множество
 * безмислени инстанции на SoapClient.
 * 
 * @created 15.03.2024
 */

class IssiSendMessage {
    /**
     * Адресът на системата на ИССИ, към който се изпращат заявките.
     * 
     * @var string
     */
    static private $wsdlService = 'https://issi.mjs.bg/issiTransfer/TransferService.svc?wsdl';

    /**
     * Ключът, предоставен от ИССИ, с чел идентификация.
     * 
     * @var string 
     */
    static private $apiKey = '';

    /**
     * Масив съдържащ опциите за SoapClient
     * 
     * @var array
     */
    static private $options = array(
        'trace' => true,
        'exceptions' => true,
        'connection_timeout' => 600,
    );

    /**
     * Променлива, която съдържа инстания на текужия клас.
     * 
     * @var IssiSendMessage
     */
    static private $instance;

    /**
     * Инстанция на SoapClient
     * 
     * @var SoapClient
     */
    private $client;

    /**
     * Конструктор на класа. Инициализира SoapClient и задава адреса, към който
     * да се изпращат заявките.
     */
    public function __construct() {
        global $DB;

        $this->client = new SoapClient(self::$wsdlService, self::$options);
        $this->client->__setLocation(self::$wsdlService);

        $apiKey = $DB->query("SELECT issiapikey FROM office");
        $apiKey = $apiKey[0];
        $apiKey = $apiKey['issiapikey'];
        self::$apiKey = $apiKey;
    }

    /**
     * Директорията за съхранение на направените заявки към
     * ИССИ с цел debug.
     * 
     * @var string
     */
    public static function getRequestLogDir() {
        return __DIR__ . '/logs/requests';
    }

    /**
     * Директорията за съхранение на върнатите отговори от
     * ИССИ с цел debug.
     * 
     * @var string
     */
    public static function getResponseLogDir() {
        return __DIR__ . '/logs/responses';
    }

    /**
     * Създава инстанция на текущия клас, ако все още няма създадена такава.
     * При наличето на вече създадена, я връща.
     * 
     * @return IssiSendMessage self::$instance Инстанцията на текущия клас
     */
    public static function getInstance() {

        if(!isset(self::$instance)) {
            self::$instance = new IssiSendMessage();
        }

        return self::$instance;
    }

    /**
     * Изпраща заявка към системата на ИССИ. Записва изпратената заявка, както и върнатия
     * отговор в два отделни xml файла. В имената на файловете се съдържа дата и часа на
     * изпратената заявка във формат {година}{месец}{ден}_{час}{минути}{секунди}. При
     * грешка с изпращането, връща false. След всеки опит за изпращане на заявка се запзва лог
     * в базата данни в таблицата issi_log. Инфорамциата, която съдържа всеки ло е дата и час,
     * булеви променливи, показващи дали заяката е успошно изпратена и дали има грешка при обработката
     * и от системата на ИССИ, както и текст със грешката или съобщението за успешно обработена информация.
     * 
     * @param string $filename Името на файла, който следва да бъде изпратен.
     * @param DateTime $dataDate Датата от регистрите, записани във файла.
     * 
     * @return bool Булева променлива който показва дали изпращането на заявката е преминало.
     */
    public function sendMessage($filename, $dataDate) {
        global $DB;

        $xmlContent = file_get_contents($filename);

        $params = array(
            'userName' => self::$apiKey,
            'password' => '',
            'request' => $xmlContent,
        );

        try {
            $this->client->__soapCall("SendMessage", array($params));

            $requestLogFilename = self::getRequestLogDir() . '/request_' . date("Ymd_His") . '.xml';
            $responseLogFilename = self::getResponseLogDir() . '/response_' . date("Ymd_His") . '.xml';
            file_put_contents($requestLogFilename, $this->client->__getLastRequest());
            file_put_contents($responseLogFilename, $this->client->__getLastResponse());

            $response = simplexml_load_string($this->client->__getLastResponse());
            $response = (string)$response->children('s', true)->Body->children()->SendMessageResponse->SendMessageResult;
            $response = html_entity_decode($response);
            $response = simplexml_load_string($response);

            $messageType = $response->children("http://issi.transfer.bg/messaging/v1")->Header->MessageType;   
            $messageType = ($messageType == 'TransferStatusResponse')? 1:0;
            if ($messageType) {
                IssiLog::addNewLog(
                    date('Y-m-d H:i:s'),
                    $dataDate->format('Y-m-d'),
                    1,
                    1,
                    null,
                    $requestLogFilename,
                    $responseLogFilename,
                    (string)$response->children("http://issi.transfer.bg/messaging/v1")->Body->TransferStatusResponse->ResponseDescription
                );
            } else {
                IssiLog::addNewLog(
                    date('Y-m-d H:i:s'),
                    $dataDate->format('Y-m-d'),
                    1,
                    0,
                    null,
                    $requestLogFilename,
                    $responseLogFilename,
                    null,
                    (string)$response->children("http://issi.transfer.bg/messaging/v1")->Body->Error->ErrorDescription
                );
            }

        } catch (SoapFault $fault) {
            
            IssiLog::addNewLog(
                date('Y-m-d H:i:s'),
                $dataDate->format('Y-m-d'),
                0,
                0,
                "faultcode: " . $fault->faultcode . ", faultstring: " . $fault->faultstring
            );
            $requestLogFilename = self::getRequestLogDir() . '/request_' . date("Ymd_His") . '.xml';
            $responseLogFilename = self::getResponseLogDir() . '/response_' . date("Ymd_His") . '.xml';
            file_put_contents($requestLogFilename, $this->client->__getLastRequest());
            file_put_contents($responseLogFilename, $this->client->__getLastResponse());

            return false;
        }

        return true;
    }
    
}