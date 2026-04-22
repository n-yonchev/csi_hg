<?php

ini_set('default_socket_timeout', 600);
error_reporting(E_ALL);
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

$date = isset($_GET['issidate']) ? new DateTime($_GET['issidate']) : new DateTime('2019-06-28');

$fileSentName = __DIR__ . '/issi_sent.xml';

$agentData = IssiExport::getAgentData();
$sendMsg = IssiSendMessage::getInstance();

$xmlGen = new IssiXmlGen($fileSentName, $agentData['agentRegNum'], $agentData['agentName']);
$xmlGen->generateBasicXmlStructure();

$regs['cases'] = [];
$regs['action'] = [];
$regs['outgoing'] = [];
$regs['incoming'] = [];
$regs['action'] = IssiExport::getAllActionsFromDate($date);

$xmlGen->addMultipleRegs($regs);

$xmlGen->saveToFile();

$sendMsg->sendMessage($fileSentName, $date);

$xmlGen = new IssiXmlGen($fileSentName, $agentData['agentRegNum'], $agentData['agentName']);
$xmlGen->generateBasicXmlStructure();

$regs['cases'] = [];
$regs['action'] = [];
$regs['outgoing'] = [];
$regs['incoming'] = [];
$regs['incoming'] = IssiExport::getAllIncomingFromDate($date);

$xmlGen->addMultipleRegs($regs);

$xmlGen->saveToFile();

$sendMsg->sendMessage($fileSentName, $date);

$xmlGen = new IssiXmlGen($fileSentName, $agentData['agentRegNum'], $agentData['agentName']);
$xmlGen->generateBasicXmlStructure();

$regs['cases'] = [];
$regs['action'] = [];
$regs['outgoing'] = [];
$regs['incoming'] = [];
$regs['outgoing'] = IssiExport::getAllOutgoingFromDate($date);

$xmlGen->addMultipleRegs($regs);

$xmlGen->saveToFile();

$sendMsg->sendMessage($fileSentName, $date);

$xmlGen = new IssiXmlGen($fileSentName, $agentData['agentRegNum'], $agentData['agentName']);
$xmlGen->generateBasicXmlStructure();

$regs['cases'] = [];
$regs['action'] = [];
$regs['outgoing'] = [];
$regs['incoming'] = [];
$regs['cases'] = IssiExport::getAllCasesFromDate($date);

$xmlGen->addMultipleRegs($regs);

$xmlGen->saveToFile();

$sendMsg->sendMessage($fileSentName, $date);

// Карайно време на изпълнението на крона.
$endingDate = new DateTime('now');
echo "End: " . $endingDate->format('Y-d-m H:i:s') . "\n";
echo "Execution time: " . $endingDate->diff($startingDate)->format('%h hours, %i minutes, %s seconds') . "\n\n\n";

// Запазване в log.txt на информация за последното изпълнение на крона.
$output = ob_get_clean();
file_put_contents(__DIR__ . '/log.txt', $output);