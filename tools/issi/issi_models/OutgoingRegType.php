<?php

namespace ISSI;

/**
 * Class representing OutgoingRegType
 *
 * Изходящ регистър
 * XSD Type: OutgoingRegType
 */
class OutgoingRegType
{

    /**
     * @property \ISSI\OutgoingRegDetailsType[] $outgoingRegDetails
     */
    private $outgoingRegDetails = array(
        
    );

    /**
     * Adds as outgoingRegDetails
     *
     * @return self
     * @param \ISSI\OutgoingRegDetailsType $outgoingRegDetails
     */
    public function addToOutgoingRegDetails(\ISSI\OutgoingRegDetailsType $outgoingRegDetails)
    {
        $this->outgoingRegDetails[] = $outgoingRegDetails;
        return $this;
    }

    /**
     * isset outgoingRegDetails
     *
     * @param int|string $index
     * @return bool
     */
    public function issetOutgoingRegDetails($index)
    {
        return isset($this->outgoingRegDetails[$index]);
    }

    /**
     * unset outgoingRegDetails
     *
     * @param int|string $index
     * @return void
     */
    public function unsetOutgoingRegDetails($index)
    {
        unset($this->outgoingRegDetails[$index]);
    }

    /**
     * Gets as outgoingRegDetails
     *
     * @return \ISSI\OutgoingRegDetailsType[]
     */
    public function getOutgoingRegDetails()
    {
        return $this->outgoingRegDetails;
    }

    /**
     * Sets a new outgoingRegDetails
     *
     * @param \ISSI\OutgoingRegDetailsType[] $outgoingRegDetails
     * @return self
     */
    public function setOutgoingRegDetails(array $outgoingRegDetails)
    {
        $this->outgoingRegDetails = $outgoingRegDetails;
        return $this;
    }


}

