<?php

namespace ISSI;

/**
 * Class representing TransferStatusResponseType
 *
 * Отговор(информация) за резултатa от обработката на данните
 * XSD Type: TransferStatusResponseType
 */
class TransferStatusResponseType
{

    /**
     * GUID (глобален уникален идентификатор) на входящото съобщение
     *
     * @property string $transferGUID
     */
    private $transferGUID = null;

    /**
     * Описание на резултата от обработката на данните
     *
     * @property string $responseDescription
     */
    private $responseDescription = null;

    /**
     * Gets as transferGUID
     *
     * GUID (глобален уникален идентификатор) на входящото съобщение
     *
     * @return string
     */
    public function getTransferGUID()
    {
        return $this->transferGUID;
    }

    /**
     * Sets a new transferGUID
     *
     * GUID (глобален уникален идентификатор) на входящото съобщение
     *
     * @param string $transferGUID
     * @return self
     */
    public function setTransferGUID($transferGUID)
    {
        $this->transferGUID = $transferGUID;
        return $this;
    }

    /**
     * Gets as responseDescription
     *
     * Описание на резултата от обработката на данните
     *
     * @return string
     */
    public function getResponseDescription()
    {
        return $this->responseDescription;
    }

    /**
     * Sets a new responseDescription
     *
     * Описание на резултата от обработката на данните
     *
     * @param string $responseDescription
     * @return self
     */
    public function setResponseDescription($responseDescription)
    {
        $this->responseDescription = $responseDescription;
        return $this;
    }


}

