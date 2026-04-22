<?php

namespace ISSI;

/**
 * Class representing AdditionalCreditorsDetailsType
 *
 *
 * XSD Type: AdditionalCreditorsDetailsType
 */
class AdditionalCreditorsDetailsType
{

    /**
     * Номер на изпълнително дело по което е въведен кредитор
     *
     * @property string $caseNum
     */
    private $caseNum = null;

    /**
     * Данни описващи кредитор
     *
     * @property \ISSI\SubjectType $creditor
     */
    private $creditor = null;

    /**
     * Описание или забележки за кредитора
     *
     * @property string $description
     */
    private $description = null;

    /**
     * Gets as caseNum
     *
     * Номер на изпълнително дело по което е въведен кредитор
     *
     * @return string
     */
    public function getCaseNum()
    {
        return $this->caseNum;
    }

    /**
     * Sets a new caseNum
     *
     * Номер на изпълнително дело по което е въведен кредитор
     *
     * @param string $caseNum
     * @return self
     */
    public function setCaseNum($caseNum)
    {
        $this->caseNum = $caseNum;
        return $this;
    }

    /**
     * Gets as creditor
     *
     * Данни описващи кредитор
     *
     * @return \ISSI\SubjectType
     */
    public function getCreditor()
    {
        return $this->creditor;
    }

    /**
     * Sets a new creditor
     *
     * Данни описващи кредитор
     *
     * @param \ISSI\SubjectType $creditor
     * @return self
     */
    public function setCreditor(\ISSI\SubjectType $creditor)
    {
        $this->creditor = $creditor;
        return $this;
    }

    /**
     * Gets as description
     *
     * Описание или забележки за кредитора
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * Описание или забележки за кредитора
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


}

