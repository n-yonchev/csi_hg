<?php

namespace ISSI;

/**
 * Class representing TransferTypeDataType
 *
 * Трансферирани регистри
 * XSD Type: TransferTypeData
 */
class TransferTypeDataType
{

    /**
     * Входящ регистър
     *
     * @property \ISSI\IncomingRegDetailsType[] $incomingReg
     */
    private $incomingReg = null;

    /**
     * Изходящ регистър
     *
     * @property \ISSI\OutgoingRegDetailsType[] $outgoingReg
     */
    private $outgoingReg = null;

    /**
     * Регистър на заведените дела
     *
     * @property \ISSI\CasesRegDetailsType[] $casesReg
     */
    private $casesReg = null;

    /**
     * Дневник на извършените действия
     *
     * @property \ISSI\ActionRegDetailsType[] $actionReg
     */
    private $actionReg = null;

    /**
     * Adds as incomingRegDetails
     *
     * Входящ регистър
     *
     * @return self
     * @param \ISSI\IncomingRegDetailsType $incomingRegDetails
     */
    public function addToIncomingReg(\ISSI\IncomingRegDetailsType $incomingRegDetails)
    {
        $this->incomingReg[] = $incomingRegDetails;
        return $this;
    }

    /**
     * isset incomingReg
     *
     * Входящ регистър
     *
     * @param int|string $index
     * @return bool
     */
    public function issetIncomingReg($index)
    {
        return isset($this->incomingReg[$index]);
    }

    /**
     * unset incomingReg
     *
     * Входящ регистър
     *
     * @param int|string $index
     * @return void
     */
    public function unsetIncomingReg($index)
    {
        unset($this->incomingReg[$index]);
    }

    /**
     * Gets as incomingReg
     *
     * Входящ регистър
     *
     * @return \ISSI\IncomingRegDetailsType[]
     */
    public function getIncomingReg()
    {
        return $this->incomingReg;
    }

    /**
     * Sets a new incomingReg
     *
     * Входящ регистър
     *
     * @param \ISSI\IncomingRegDetailsType[] $incomingReg
     * @return self
     */
    public function setIncomingReg(array $incomingReg)
    {
        $this->incomingReg = $incomingReg;
        return $this;
    }

    /**
     * Adds as outgoingRegDetails
     *
     * Изходящ регистър
     *
     * @return self
     * @param \ISSI\OutgoingRegDetailsType $outgoingRegDetails
     */
    public function addToOutgoingReg(\ISSI\OutgoingRegDetailsType $outgoingRegDetails)
    {
        $this->outgoingReg[] = $outgoingRegDetails;
        return $this;
    }

    /**
     * isset outgoingReg
     *
     * Изходящ регистър
     *
     * @param int|string $index
     * @return bool
     */
    public function issetOutgoingReg($index)
    {
        return isset($this->outgoingReg[$index]);
    }

    /**
     * unset outgoingReg
     *
     * Изходящ регистър
     *
     * @param int|string $index
     * @return void
     */
    public function unsetOutgoingReg($index)
    {
        unset($this->outgoingReg[$index]);
    }

    /**
     * Gets as outgoingReg
     *
     * Изходящ регистър
     *
     * @return \ISSI\OutgoingRegDetailsType[]
     */
    public function getOutgoingReg()
    {
        return $this->outgoingReg;
    }

    /**
     * Sets a new outgoingReg
     *
     * Изходящ регистър
     *
     * @param \ISSI\OutgoingRegDetailsType[] $outgoingReg
     * @return self
     */
    public function setOutgoingReg(array $outgoingReg)
    {
        $this->outgoingReg = $outgoingReg;
        return $this;
    }

    /**
     * Adds as casesRegDetails
     *
     * Регистър на заведените дела
     *
     * @return self
     * @param \ISSI\CasesRegDetailsType $casesRegDetails
     */
    public function addToCasesReg(\ISSI\CasesRegDetailsType $casesRegDetails)
    {
        $this->casesReg[] = $casesRegDetails;
        return $this;
    }

    /**
     * isset casesReg
     *
     * Регистър на заведените дела
     *
     * @param int|string $index
     * @return bool
     */
    public function issetCasesReg($index)
    {
        return isset($this->casesReg[$index]);
    }

    /**
     * unset casesReg
     *
     * Регистър на заведените дела
     *
     * @param int|string $index
     * @return void
     */
    public function unsetCasesReg($index)
    {
        unset($this->casesReg[$index]);
    }

    /**
     * Gets as casesReg
     *
     * Регистър на заведените дела
     *
     * @return \ISSI\CasesRegDetailsType[]
     */
    public function getCasesReg()
    {
        return $this->casesReg;
    }

    /**
     * Sets a new casesReg
     *
     * Регистър на заведените дела
     *
     * @param \ISSI\CasesRegDetailsType[] $casesReg
     * @return self
     */
    public function setCasesReg(array $casesReg)
    {
        $this->casesReg = $casesReg;
        return $this;
    }

    /**
     * Adds as actionRegDetails
     *
     * Дневник на извършените действия
     *
     * @return self
     * @param \ISSI\ActionRegDetailsType $actionRegDetails
     */
    public function addToActionReg(\ISSI\ActionRegDetailsType $actionRegDetails)
    {
        $this->actionReg[] = $actionRegDetails;
        return $this;
    }

    /**
     * isset actionReg
     *
     * Дневник на извършените действия
     *
     * @param int|string $index
     * @return bool
     */
    public function issetActionReg($index)
    {
        return isset($this->actionReg[$index]);
    }

    /**
     * unset actionReg
     *
     * Дневник на извършените действия
     *
     * @param int|string $index
     * @return void
     */
    public function unsetActionReg($index)
    {
        unset($this->actionReg[$index]);
    }

    /**
     * Gets as actionReg
     *
     * Дневник на извършените действия
     *
     * @return \ISSI\ActionRegDetailsType[]
     */
    public function getActionReg()
    {
        return $this->actionReg;
    }

    /**
     * Sets a new actionReg
     *
     * Дневник на извършените действия
     *
     * @param \ISSI\ActionRegDetailsType[] $actionReg
     * @return self
     */
    public function setActionReg(array $actionReg)
    {
        $this->actionReg = $actionReg;
        return $this;
    }


}

