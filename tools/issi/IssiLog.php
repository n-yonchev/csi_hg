<?php

/**
 * Клас IssiLog oтговаря за логовете, които се пазят в базата 
 * данни от изпратените заявки към ИССИ.
 * 
 * @created 09.04.2024
 */
class IssiLog {
    /**
     * Добавя нов лог в базата данни и обновява дата на последната успешна завяка.
     * 
     * @param string $date Датата на изпращане на заявката във формат Y-d-m H:i:s.
     * @param string $dataDate Датата на регистрите от заявката.
     * @param int $requestSuccess Дали заявката е изпратена успешно.
     * @param int $dataSuccess Дали информацията е обработена успешно от ИССИ.
     * @param string $soapError Съобщение за грешка от SoapClient, ако има такова.
     * @param string $requestFile Името и пътя до xml файла, който съдържа пълната заявка.
     * @param string $responseFile Името и пътя до xml файла, който съдържа пълния отговор.
     * @param string $successMessage Съобщение за успешно обработена информация от ИССИ, ако има такова.
     * @param string $errorMessage Съобщение за възникнала грешка при обработката на 
     * информация от ИССИ, ако има такова.
     */
    public static function addNewLog($date, $dataDate, 
    $requestSuccess, $dataSuccess, $soapError, 
    $requestFile = null, $responseFile = null,
    $successMessage = null, $errorMessage = null) {
        global $DB;

        $query = "INSERT INTO 
        issi_log(
            date,
            data_date,
            request_file,
            response_file,
            request_success,
            data_success,
            success_message,
            error_message,
            soap_error
        ) VALUES ( 
            '{$date}', 
            '{$dataDate}', 
            '{$requestFile}', 
            '{$responseFile}', 
            {$requestSuccess}, 
            {$dataSuccess}, 
            '{$successMessage}', 
            '{$errorMessage}', 
            '{$soapError}'
        )";

        $DB->query($query);

        if($requestSuccess) {
            $query = "UPDATE issi_last_success SET date = '{$dataDate}' WHERE date < '{$dataDate}'";

            $DB->query($query);
        }
    }

    /**
     * Връща дата на последната успешно изпратена заявка към ИССИ.
     * Тя се пази в таблицата "issi_last_success".
     * 
     * @return DateTime
     */
    public static function getLastSuccessRequestDate() {
        global $DB;

        $date = $DB->query("SELECT * FROM issi_last_success LIMIT 1");
        $date = $date[0];
        return new DateTime($date['date']);
    }
}