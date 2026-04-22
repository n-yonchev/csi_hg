<?php

namespace ISSI;

/**
 * Class representing CasesRegType
 *
 * Регистър на заведените дела
 * XSD Type: CasesRegType
 */
class CasesRegType
{

    /**
     * @property \ISSI\CasesRegDetailsType[] $casesRegDetails
     */
    private $casesRegDetails = array(
        
    );

    /**
     * Adds as casesRegDetails
     *
     * @return self
     * @param \ISSI\CasesRegDetailsType $casesRegDetails
     */
    public function addToCasesRegDetails(\ISSI\CasesRegDetailsType $casesRegDetails)
    {
        $this->casesRegDetails[] = $casesRegDetails;
        return $this;
    }

    /**
     * isset casesRegDetails
     *
     * @param int|string $index
     * @return bool
     */
    public function issetCasesRegDetails($index)
    {
        return isset($this->casesRegDetails[$index]);
    }

    /**
     * unset casesRegDetails
     *
     * @param int|string $index
     * @return void
     */
    public function unsetCasesRegDetails($index)
    {
        unset($this->casesRegDetails[$index]);
    }

    /**
     * Gets as casesRegDetails
     *
     * @return \ISSI\CasesRegDetailsType[]
     */
    public function getCasesRegDetails()
    {
        return $this->casesRegDetails;
    }

    /**
     * Sets a new casesRegDetails
     *
     * @param \ISSI\CasesRegDetailsType[] $casesRegDetails
     * @return self
     */
    public function setCasesRegDetails(array $casesRegDetails)
    {
        $this->casesRegDetails = $casesRegDetails;
        return $this;
    }


}

