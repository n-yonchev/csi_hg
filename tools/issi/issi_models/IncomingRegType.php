<?php

namespace ISSI;

/**
 * Class representing IncomingRegType
 *
 * Входящ регистър
 * XSD Type: IncomingRegType
 */
class IncomingRegType
{

    /**
     * @property \ISSI\IncomingRegDetailsType[] $incomingRegDetails
     */
    private $incomingRegDetails = array(
        
    );

    /**
     * Adds as incomingRegDetails
     *
     * @return self
     * @param \ISSI\IncomingRegDetailsType $incomingRegDetails
     */
    public function addToIncomingRegDetails(\ISSI\IncomingRegDetailsType $incomingRegDetails)
    {
        $this->incomingRegDetails[] = $incomingRegDetails;
        return $this;
    }

    /**
     * isset incomingRegDetails
     *
     * @param int|string $index
     * @return bool
     */
    public function issetIncomingRegDetails($index)
    {
        return isset($this->incomingRegDetails[$index]);
    }

    /**
     * unset incomingRegDetails
     *
     * @param int|string $index
     * @return void
     */
    public function unsetIncomingRegDetails($index)
    {
        unset($this->incomingRegDetails[$index]);
    }

    /**
     * Gets as incomingRegDetails
     *
     * @return \ISSI\IncomingRegDetailsType[]
     */
    public function getIncomingRegDetails()
    {
        return $this->incomingRegDetails;
    }

    /**
     * Sets a new incomingRegDetails
     *
     * @param \ISSI\IncomingRegDetailsType[] $incomingRegDetails
     * @return self
     */
    public function setIncomingRegDetails(array $incomingRegDetails)
    {
        $this->incomingRegDetails = $incomingRegDetails;
        return $this;
    }


}

