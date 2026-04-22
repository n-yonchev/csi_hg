<?php

use ISSI\ActionRegDetailsType;
use ISSI\ActionRegType;
use ISSI\AdditionalCreditorsDetailsType;
use ISSI\CasesRegDetailsType;
use ISSI\DeliveryType;
use ISSI\EntityBasicDataType;
use ISSI\IncomingRegDetailsType;
use ISSI\OutgoingRegDetailsType;
use ISSI\PersonBasicDataType;
use ISSI\PersonIdentifierType;
use ISSI\SubjectType;

class IssiTests {
    public static function checkTwoVars($expected, $tested, $name) {
        if(trim($expected) != trim($tested)) {
            echo "<div style='background-color: #ff8a8a; margin-top: 1px; margin-bottom: 1px; padding: 2px;'>The {$name} is different. Expected: {$expected} | Given: {$tested}</div>";
            return false;
        }

        echo "<div style='background-color: #8affa9; margin-top: 1px; margin-bottom: 1px; padding: 2px;'>The {$name} is as expected. Expected: {$expected} | Given: {$tested}</div>";
        return true;
    }

    public static function testCaseExport() {        
        $caseId = 8096;

        mb_internal_encoding("UTF-8");
        
        $expectedData = new CasesRegDetailsType();
        $expectedData->setCaseNum('20178890400067');
        $expectedData->setCaseDate(new DateTime('2017-01-20', IssiExport::getTimeZone()));
        $expectedData->setRegNumber('1095/2017');
        $expectedData->setRegDate(new DateTime('2017-01-20 11:51:18', IssiExport::getTimeZone()));
        $expectedData->setCourtCase('Îêðúæåí ñúä Ïàçàðäæèê');
        $expectedData->setAgentName('Äåíèöà Éîðäàíîâà Ñòàí÷åâà');
        $expectedData->setAgentRegNum('889');
        $expectedData->setDebtType(1);
        $expectedData->setDebt(2426.65);
        $expectedData->setDebtDescription('ÏÀÐÈ×ÍÎ');
        $expectedData->setDebtOrigin('íåîïðåä.ïðàâà ïî ÷ë.18 Ç×ÑÈ');
        //$expectedData->setStopedDate(new DateTime('2016-08-05', IssiExport::getTimeZone()));
        $expectedData->setDescription('ÏÀÐÈ×ÍÎ ÂÇÅÌÀÍÅ');
        $expectedData->setNotes('');

        $subject = new SubjectType();
        $entity = new EntityBasicDataType();
        $entity->setName('ÎÊÐÚÆÅÍ ÑÚÄ ÏÀÇÀÐÄÆÈÊ');
        $entity->setIdentifier('000351953');
        $entity->setAddress('ÃÐ.ÏÀÇÀÐÄÆÈÊ, ÓË.ÕÀÍ ÊÐÓÌ ¹ 3 ');
        $subject->setEntity($entity);
        $expectedData->setCreditor($subject);

        $additional = new AdditionalCreditorsDetailsType();
        $subject = new SubjectType();
        $entity = new EntityBasicDataType();
        $entity->setName('ÒÄ íà ÍÀÏ ÃÐ. ÏËÎÂÄÈÂ, ÎÔÈÑ ÏÀÇÀÐÄÆÈÊ');
        $entity->setIdentifier('131063188');
        $entity->setAddress('ÃÐ. ÏÀÇÀÐÄÆÈÊ, ÓË. ÀÑÅÍ ÇËÀÒÀÐÅÂ 7');
        $subject->setEntity($entity);
        $additional->setCreditor($subject);
        $expectedData->setAdditionalCreditors([$additional]);

        $subject = new SubjectType();
        $entity = new PersonBasicDataType();
        $entity->setName('ÃÅÎÐÃÈ ÁÎÍ×ÅÂ ÃÅÎÐÃÈÅÂ');
        $id = new PersonIdentifierType();
        $id->setEGN('8308213482');
        $entity->setIdentifier($id);
        $entity->setAddress('Ñ.ÑÀÐÀß, ÓË.ÑÅÄÌÀ 11');
        $subject->setPerson($entity);
        $expectedData->setDebtor($subject);

        $testedData = IssiExport::getDataForCase($caseId);

        $allTests = [];

        $allTests[] = self::checkTwoVars($expectedData->getCaseNum(), $testedData->getCaseNum(), 'CaseNum');
        $allTests[] = self::checkTwoVars($expectedData->getCaseDate()->format('Y-m-d H:i:s'),  $testedData->getCaseDate()->format('Y-m-d H:i:s'), 'CaseDate');
        $allTests[] = self::checkTwoVars($expectedData->getRegNumber(),  $testedData->getRegNumber(), 'RegNumber');
        $allTests[] = self::checkTwoVars($expectedData->getRegDate()->format('Y-m-d H:i:s'),  $testedData->getRegDate()->format('Y-m-d H:i:s'), 'RegDate');
        $allTests[] = self::checkTwoVars($expectedData->getCourtCase(),  $testedData->getCourtCase(), 'CourtCase');
        $allTests[] = self::checkTwoVars($expectedData->getAgentName(),  $testedData->getAgentName(), 'AgentName');
        $allTests[] = self::checkTwoVars($expectedData->getAgentRegNum(),  $testedData->getAgentRegNum(), 'AgentRegNum');
        $allTests[] = self::checkTwoVars($expectedData->getDebtType(),  $testedData->getDebtType(), 'DebtType');
        $allTests[] = self::checkTwoVars($expectedData->getDebt(),  $testedData->getDebt(), 'Debt');
        $allTests[] = self::checkTwoVars($expectedData->getDebtDescription(),  $testedData->getDebtDescription(), 'DebtDescription');
        // $allTests[] = self::checkTwoVars($expectedData->getStopedDate()->format('Y-m-d H:i:s'),  $testedData->getStopedDate()->format('Y-m-d H:i:s'), 'StopedDate');
        // $allTests[] = self::checkTwoVars($expectedData->getResumedDate()->format('Y-m-d H:i:s'),  $testedData->getResumedDate()->format('Y-m-d H:i:s'), 'ResumedDate');
        // $allTests[] = self::checkTwoVars($expectedData->getTerminationDate()->format('Y-m-d H:i:s'),  $testedData->getTerminationDate()->format('Y-m-d H:i:s'), 'TerminationDate');
        // $allTests[] = self::checkTwoVars($expectedData->getTransferredDate()->format('Y-m-d H:i:s'),  $testedData->getTransferredDate()->format('Y-m-d H:i:s'), 'TransferredDate');
        $allTests[] = self::checkTwoVars($expectedData->getDescription(),  $testedData->getDescription(), 'Description');
        $allTests[] = self::checkTwoVars($expectedData->getNotes(),  $testedData->getNotes(), 'Notes');
        $allTests[] = self::checkTwoVars($expectedData->getCreditor()->getEntity()->getName(),  $testedData->getCreditor()->getEntity()->getName(), 'Creditor Name');
        $allTests[] = self::checkTwoVars($expectedData->getCreditor()->getEntity()->getIdentifier(),  $testedData->getCreditor()->getEntity()->getIdentifier(), 'Creditor Identifier');
        $allTests[] = self::checkTwoVars($expectedData->getCreditor()->getEntity()->getAddress(),  $testedData->getCreditor()->getEntity()->getAddress(), 'Creditor Address');
        $allTests[] = self::checkTwoVars($expectedData->getDebtor()->getPerson()->getName(),  $testedData->getDebtor()->getPerson()->getName(), 'Debtor Name');
        $allTests[] = self::checkTwoVars($expectedData->getDebtor()->getPerson()->getIdentifier()->getEGN(),  $testedData->getDebtor()->getPerson()->getIdentifier()->getEGN(), 'Debtor Identifier');
        $allTests[] = self::checkTwoVars($expectedData->getDebtor()->getPerson()->getAddress(),  $testedData->getDebtor()->getPerson()->getAddress(), 'Debtor Address');
        $allTests[] = self::checkTwoVars($expectedData->getAdditionalCreditors()[0]->getCreditor()->getEntity()->getName(),  $testedData->getAdditionalCreditors()[0]->getCreditor()->getEntity()->getName(), 'AdditionalCreditors[0] Name');
        $allTests[] = self::checkTwoVars($expectedData->getAdditionalCreditors()[0]->getCreditor()->getEntity()->getIdentifier(),  $testedData->getAdditionalCreditors()[0]->getCreditor()->getEntity()->getIdentifier(), 'AdditionalCreditors[0] Identifier');
        $allTests[] = self::checkTwoVars($expectedData->getAdditionalCreditors()[0]->getCreditor()->getEntity()->getAddress(),  $testedData->getAdditionalCreditors()[0]->getCreditor()->getEntity()->getAddress(), 'AdditionalCreditors[0] Address');
    
        return !in_array(false, $allTests);
    }
    
    public static function testIncomingExport() {
        $incomingId = 85698;

        mb_internal_encoding("UTF-8");

        $expectedData = new IncomingRegDetailsType();
        $expectedData->setRegDate(new DateTime('2015-04-21 11:41:19', IssiExport::getTimeZone()));
        $expectedData->setRegNumber('3124');
        $expectedData->setCaseNum('20158890400001');
        $expectedData->setCaseDate(new DateTime('2015-01-06', IssiExport::getTimeZone()));
        $subject = new SubjectType();
        $subject->setEntity(new EntityBasicDataType());
        $subject->getEntity()->setName('ÁÀÍÊÀ ÏÈÐÅÎÑ ÁÚËÃÀÐÈß ÀÄ');
        $expectedData->setSubject($subject);
        $expectedData->setDelivery(new DeliveryType());
        $expectedData->getDelivery()->setDeliveryId(7);
        $expectedData->getDelivery()->setDeliveryName('Ëè÷íî');
        $expectedData->setDocSubCategoryCode(13);
        $expectedData->setDescription('ìîëáà');
        $expectedData->setNotes('');

        $testedData = IssiExport::getDataForIncoming($incomingId);

        $allTests = [];

        $allTests[] = self::checkTwoVars($expectedData->getCaseNum(), $testedData->getCaseNum(), 'CaseNum');
        $allTests[] = self::checkTwoVars($expectedData->getCaseDate()->format('Y-m-d H:i:s'),  $testedData->getCaseDate()->format('Y-m-d H:i:s'), 'CaseDate');
        $allTests[] = self::checkTwoVars($expectedData->getRegNumber(),  $testedData->getRegNumber(), 'RegNumber');
        $allTests[] = self::checkTwoVars($expectedData->getRegDate()->format('Y-m-d H:i:s'),  $testedData->getRegDate()->format('Y-m-d H:i:s'), 'RegDate');
        $allTests[] = self::checkTwoVars($expectedData->getDescription(),  $testedData->getDescription(), 'Description');
        $allTests[] = self::checkTwoVars($expectedData->getNotes(),  $testedData->getNotes(), 'Notes');
        $allTests[] = self::checkTwoVars($expectedData->getSubject()->getEntity()->getName(),  $testedData->getSubject()->getEntity()->getName(), 'Subject Name');
        $allTests[] = self::checkTwoVars($expectedData->getDelivery()->getDeliveryId(), $testedData->getDelivery()->getDeliveryId(), 'Delivery Id');
        $allTests[] = self::checkTwoVars($expectedData->getDelivery()->getDeliveryName(), mb_convert_encoding($testedData->getDelivery()->getDeliveryName(), "UTF-8", "Windows-1251"), 'Delivery Name');
        $allTests[] = self::checkTwoVars($expectedData->getDocSubCategoryCode(), $testedData->getDocSubCategoryCode(), 'DocSubCode');

        return !in_array(false, $allTests);
    }

    public static function testOutgoingExport() {
        $outgoingId = 206073;

        mb_internal_encoding("UTF-8");
        
        $expectedData = new OutgoingRegDetailsType();
        $expectedData->setRegNumber('16359');
        $expectedData->setRegDate(new DateTime('2018-07-25 16:32:04', IssiExport::getTimeZone()));
        $expectedData->setCaseNum('20188890401298');
        $expectedData->setCaseDate(new DateTime('2018-05-17'));
        $subject = new SubjectType();
        $subject->setEntity(new EntityBasicDataType());
        $subject->getEntity()->setName('ÁÀÍÊÀ ÄÑÊ ÅÀÄ ');
        $expectedData->setSubject($subject);
        $expectedData->setDelivery(new DeliveryType());
        $expectedData->getDelivery()->setDeliveryId(1);
        $expectedData->getDelivery()->setDeliveryName('Ïðåïîðú÷àíî ïèñìî');
        $expectedData->setDocSubCategoryCode(106);
        $expectedData->setDescription('ñúîáùåíèå');
        $expectedData->setNotes('');

        $testedData = IssiExport::getDataForOutgoing($outgoingId);

        $allTests[] = self::checkTwoVars($expectedData->getCaseNum(), $testedData->getCaseNum(), 'CaseNum');
        $allTests[] = self::checkTwoVars($expectedData->getCaseDate()->format('Y-m-d H:i:s'),  $testedData->getCaseDate()->format('Y-m-d H:i:s'), 'CaseDate');
        $allTests[] = self::checkTwoVars($expectedData->getRegNumber(),  $testedData->getRegNumber(), 'RegNumber');
        $allTests[] = self::checkTwoVars($expectedData->getRegDate()->format('Y-m-d H:i:s'),  $testedData->getRegDate()->format('Y-m-d H:i:s'), 'RegDate');
        $allTests[] = self::checkTwoVars($expectedData->getDescription(),  $testedData->getDescription(), 'Description');
        $allTests[] = self::checkTwoVars($expectedData->getNotes(),  $testedData->getNotes(), 'Notes');
        $allTests[] = self::checkTwoVars($expectedData->getSubject()->getEntity()->getName(),  $testedData->getSubject()->getEntity()->getName(), 'Subject Name');
        $allTests[] = self::checkTwoVars($expectedData->getDelivery()->getDeliveryId(), $testedData->getDelivery()->getDeliveryId(), 'Delivery Id');
        $allTests[] = self::checkTwoVars($expectedData->getDelivery()->getDeliveryName(), mb_convert_encoding($testedData->getDelivery()->getDeliveryName(), "UTF-8", "Windows-1251"), 'Delivery Name');
        $allTests[] = self::checkTwoVars($expectedData->getDocSubCategoryCode(), $testedData->getDocSubCategoryCode(), 'DocSubCode');

        return !in_array(false, $allTests);
    }

    public static function testActionExposrt() {
        $actionId = 123772;
        $actionType = 2;

        mb_internal_encoding("UTF-8");

        $expectedData = new ActionRegDetailsType();
        $expectedData->setActionDate(new DateTime('2016-03-01 15:16:49', IssiExport::getTimeZone()));
        $expectedData->setActionNumber('163');
        $expectedData->setCaseNum('20158890400601');
        $expectedData->setCaseDate(new DateTime('2015-07-06', IssiExport::getTimeZone()));
        $expectedData->setLiableSubject(new SubjectType());
        $expectedData->getLiableSubject()->setEntity(new EntityBasicDataType());
        $expectedData->getLiableSubject()->getEntity()->setName('ÂÀÑÈËÊÀ ÍÈÊÎËÎÂÀ ');
        $expectedData->setActionTypeID(197);
        $expectedData->setDescription('ÑÚÎÁÙÅÍÈÅ ÇÀ ÑÂ. ÄÅËÎ ÄÎ ÄË.');

        $testedData = IssiExport::getDataForAction($actionId, $actionType);

        $allTests[] = self::checkTwoVars($expectedData->getCaseNum(), $testedData->getCaseNum(), 'CaseNum');
        $allTests[] = self::checkTwoVars($expectedData->getCaseDate()->format('Y-m-d H:i:s'),  $testedData->getCaseDate()->format('Y-m-d H:i:s'), 'CaseDate');
        $allTests[] = self::checkTwoVars($expectedData->getActionNumber(),  $testedData->getActionNumber(), 'ActionNumber');
        $allTests[] = self::checkTwoVars($expectedData->getActionDate()->format('Y-m-d H:i:s'),  $testedData->getActionDate()->format('Y-m-d H:i:s'), 'getLiableSubjectActionDate');
        $allTests[] = self::checkTwoVars($expectedData->getDescription(),  $testedData->getDescription(), 'Description');
        $allTests[] = self::checkTwoVars($expectedData->getNotes(),  $testedData->getNotes(), 'Notes');
        $allTests[] = self::checkTwoVars($expectedData->getLiableSubject()->getEntity()->getName(),  $testedData->getLiableSubject()->getEntity()->getName(), 'LiableSubject Name');
        $allTests[] = self::checkTwoVars($expectedData->getActionTypeID(), $testedData->getActionTypeID(), 'getActionTypeID');

        return !in_array(false, $allTests);
    }

    public static function runTest($test) {
        echo '<div style="font-size: 20; margin-bottom: 10px; margin-top: 20px;">Testing: ' . $test . '</div><div style="padding-left: 10px">';
        if(self::$test()) {
            echo '<div style="background-color: #26ff52; font-size: 18; margin-top: 5px"> Test finished successfully with no errors! </div>';
        } else {
            echo '<div style="background-color: #fc3838; font-size: 18; margin-top: 5px"> Some tests did not pass!</div>';
        }
        echo '</div>';
    }

    public static function runAllTests() {
        self::runTest('testCaseExport');
        self::runTest('testIncomingExport');
        self::runTest('testOutgoingExport');
        self::runTest('testActionExposrt');
    }
}