<?php

namespace ISSI\TransferMessage;

/**
 * Class representing BodyAType
 */
class BodyAType
{

    /**
     * Масив от данни експортирани от регистри на ЧСИ
     *
     * @property \ISSI\TransferTypeDataType $transferData
     */
    private $transferData = null;

    /**
     * Известие за резултатa от обработката на данните
     *
     * @property \ISSI\TransferStatusResponseType $transferStatusResponse
     */
    private $transferStatusResponse = null;

    /**
     * Известие за грешка
     *
     * @property \ISSI\ErrorMessageType $error
     */
    private $error = null;

    /**
     * Gets as transferData
     *
     * Масив от данни експортирани от регистри на ЧСИ
     *
     * @return \ISSI\TransferTypeDataType
     */
    public function getTransferData()
    {
        return $this->transferData;
    }

    /**
     * Sets a new transferData
     *
     * Масив от данни експортирани от регистри на ЧСИ
     *
     * @param \ISSI\TransferTypeDataType $transferData
     * @return self
     */
    public function setTransferData(\ISSI\TransferTypeDataType $transferData)
    {
        $this->transferData = $transferData;
        return $this;
    }

    /**
     * Gets as transferStatusResponse
     *
     * Известие за резултатa от обработката на данните
     *
     * @return \ISSI\TransferStatusResponseType
     */
    public function getTransferStatusResponse()
    {
        return $this->transferStatusResponse;
    }

    /**
     * Sets a new transferStatusResponse
     *
     * Известие за резултатa от обработката на данните
     *
     * @param \ISSI\TransferStatusResponseType $transferStatusResponse
     * @return self
     */
    public function setTransferStatusResponse(\ISSI\TransferStatusResponseType $transferStatusResponse)
    {
        $this->transferStatusResponse = $transferStatusResponse;
        return $this;
    }

    /**
     * Gets as error
     *
     * Известие за грешка
     *
     * @return \ISSI\ErrorMessageType
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Sets a new error
     *
     * Известие за грешка
     *
     * @param \ISSI\ErrorMessageType $error
     * @return self
     */
    public function setError(\ISSI\ErrorMessageType $error)
    {
        $this->error = $error;
        return $this;
    }


}

