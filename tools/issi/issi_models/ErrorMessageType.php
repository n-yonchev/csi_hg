<?php

namespace ISSI;

/**
 * Class representing ErrorMessageType
 *
 * Съобщение за грешка, възникнала в процеса на обработка на данните
 * XSD Type: ErrorMessageType
 */
class ErrorMessageType
{

    /**
     * GUID (глобален уникален идентификатор) на входящото съобщение, което е предизвикало грешката
     *
     * @property string $transferGUID
     */
    private $transferGUID = null;

    /**
     * Описание на грешката
     *
     * @property string $errorDescription
     */
    private $errorDescription = null;

    /**
     * Gets as transferGUID
     *
     * GUID (глобален уникален идентификатор) на входящото съобщение, което е предизвикало грешката
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
     * GUID (глобален уникален идентификатор) на входящото съобщение, което е предизвикало грешката
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
     * Gets as errorDescription
     *
     * Описание на грешката
     *
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * Sets a new errorDescription
     *
     * Описание на грешката
     *
     * @param string $errorDescription
     * @return self
     */
    public function setErrorDescription($errorDescription)
    {
        $this->errorDescription = $errorDescription;
        return $this;
    }


}

