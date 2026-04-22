<?php

// error_reporting(E_ALL);
mb_internal_encoding("UTF-8");

ob_start();

include_once "csi_sys/commdb.php";
include_once "csi_sys/common.php";
include_once "csi_sys/commspec.php";
include_once 'issi_models/CasesRegDetailsType.php';
include_once 'issi_models/EntityBasicDataType.php';
include_once 'issi_models/PersonBasicDataType.php';
include_once 'issi_models/PersonIdentifierType.php';
include_once 'issi_models/SubjectType.php';
include_once 'issi_models/AdditionalDebtorsDetailsType.php';
include_once 'issi_models/AdditionalCreditorsDetailsType.php';
include_once 'issi_models/ActionRegDetailsType.php';
include_once 'issi_models/OutgoingRegDetailsType.php';
include_once 'issi_models/IncomingRegDetailsType.php';
include_once 'issi_models/DeliveryType.php';
include_once 'IssiExport.php';
include_once 'IssiXmlGen.php';
include_once 'IssiSendMessage.php';
include_once 'IssiLog.php';

// Начлно време на изпълнението на крона.
$startingDate = new DateTime('now');
echo "Start: " . $startingDate->format('Y-d-m H:i:s') . "\n\n\n";

// Дата на регистъра който ще бъде изпратен.
// ВАЖНО!!! Взима се вчерашна дата, тъй като крона се изпълнява след 00:00 часа.
$date = new DateTime('now');
$date->modify('-1 day');

$fileSentName = __DIR__ . '/issi_sent.xml';

$agentData = IssiExport::getAgentData();

// Последната дата, на която се е изпълнила успешно заявака.
$lastSuccessDate = IssiLog::getLastSuccessRequestDate()->modify('+1 day');

// Изпращат се завки с регистрите за всички от последната успешна до вчерашна дата,
// като се започва от датата след последната изпратена успешно заявка.
// БЕЛЕЖКА: Максимум за пет дни
for($i = 1;($lastSuccessDate < $date) && ($i <= 3); $i++) {
    $xmlGen = new IssiXmlGen($fileSentName, $agentData['agentRegNum'], $agentData['agentName']);
    $xmlGen->generateBasicXmlStructure();

    $regs = IssiExport::getAllRegsFromDate($lastSuccessDate);

    $regsCount = count($regs['cases']) + count($regs['action']) + count($regs['outgoing']) + count($regs['incoming']);

    $sendMsg = IssiSendMessage::getInstance();

    if ($regsCount > 600) {
        $actionRegs = $regs['action'];

        $regs['action'] = [];

        $xmlGen->addMultipleRegs($regs);
        $xmlGen->saveToFile();

        $sendMsg->sendMessage($fileSentName, $lastSuccessDate);

        $regs['action'] = $actionRegs;
        unset($regs['cases']);
        unset($regs['outgoing']);
        unset($regs['incoming']);
        $regs['cases'] = [];
        $regs['outgoing'] = [];
        $regs['incoming'] = [];

        $xmlGen = new IssiXmlGen($fileSentName, $agentData['agentRegNum'], $agentData['agentName']);
        $xmlGen->generateBasicXmlStructure();

        $xmlGen->addMultipleRegs($regs);

        $xmlGen->saveToFile();

        $sendMsg->sendMessage($fileSentName, $lastSuccessDate);
    } else {
        $xmlGen->addMultipleRegs($regs);

        $xmlGen->saveToFile();

        $sendMsg->sendMessage($fileSentName, $lastSuccessDate);
    }

    $lastSuccessDate->modify('+1 day');
}

// Карайно време на изпълнението на крона.
$endingDate = new DateTime('now');
echo "End: " . $endingDate->format('Y-d-m H:i:s') . "\n";
echo "Execution time: " . $endingDate->diff($startingDate)->format('%h hours, %i minutes, %s seconds') . "\n\n\n";

// Запазване в log.txt на информация за последното изпълнение на крона.
$output = ob_get_clean();
$outputFileName = __DIR__ . '/log.txt';
file_put_contents($outputFileName, $output);