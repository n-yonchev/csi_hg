<?php

namespace ISSI;

/**
 * Class representing AdditionalDebtorsDetailsType
 *
 *
 * XSD Type: AdditionalDebtorsDetailsType
 */
class AdditionalDebtorsDetailsType
{

    /**
     * Номер на изпълнително дело по което е въведен длъжник
     *
     * @property string $caseNum
     */
    private $caseNum = null;

    /**
     * Данни описващи длъжник
     *
     * @property \ISSI\SubjectType $debtor
     */
    private $debtor = null;

    /**
     * Описание или забележки за длъжника
     *
     * @property string $description
     */
    private $description = null;

    /**
     * Gets as caseNum
     *
     * Номер на изпълнително дело по което е въведен длъжник
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
     * Номер на изпълнително дело по което е въведен длъжник
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
     * Gets as debtor
     *
     * Данни описващи длъжник
     *
     * @return \ISSI\SubjectType
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * Sets a new debtor
     *
     * Данни описващи длъжник
     *
     * @param \ISSI\SubjectType $debtor
     * @return self
     */
    public function setDebtor(\ISSI\SubjectType $debtor)
    {
        $this->debtor = $debtor;
        return $this;
    }

    /**
     * Gets as description
     *
     * Описание или забележки за длъжника
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
     * Описание или забележки за длъжника
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

