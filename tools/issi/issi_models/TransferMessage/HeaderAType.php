<?php

namespace ISSI\TransferMessage;

/**
 * Class representing HeaderAType
 */
class HeaderAType
{

    /**
     * Тип на съобщение
     *
     * @property string $messageType
     */
    private $messageType = null;

    /**
     * Идентификация на съдебен изпълнител
     *
     * @property \ISSI\EnforcementAgentType $enforcementAgentType
     */
    private $enforcementAgentType = null;

    /**
     * Дата/час на създаване
     *
     * @property \DateTime $transferDate
     */
    private $transferDate = null;

    /**
     * GUID (глобален уникален идентификатор) на трансферно съобщение
     *
     * @property string $transferGUID
     */
    private $transferGUID = null;

    /**
     * Gets as messageType
     *
     * Тип на съобщение
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Sets a new messageType
     *
     * Тип на съобщение
     *
     * @param string $messageType
     * @return self
     */
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
        return $this;
    }

    /**
     * Gets as enforcementAgentType
     *
     * Идентификация на съдебен изпълнител
     *
     * @return \ISSI\EnforcementAgentType
     */
    public function getEnforcementAgentType()
    {
        return $this->enforcementAgentType;
    }

    /**
     * Sets a new enforcementAgentType
     *
     * Идентификация на съдебен изпълнител
     *
     * @param \ISSI\EnforcementAgentType $enforcementAgentType
     * @return self
     */
    public function setEnforcementAgentType(\ISSI\EnforcementAgentType $enforcementAgentType)
    {
        $this->enforcementAgentType = $enforcementAgentType;
        return $this;
    }

    /**
     * Gets as transferDate
     *
     * Дата/час на създаване
     *
     * @return \DateTime
     */
    public function getTransferDate()
    {
        return $this->transferDate;
    }

    /**
     * Sets a new transferDate
     *
     * Дата/час на създаване
     *
     * @param \DateTime $transferDate
     * @return self
     */
    public function setTransferDate(\DateTime $transferDate)
    {
        $this->transferDate = $transferDate;
        return $this;
    }

    /**
     * Gets as transferGUID
     *
     * GUID (глобален уникален идентификатор) на трансферно съобщение
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
     * GUID (глобален уникален идентификатор) на трансферно съобщение
     *
     * @param string $transferGUID
     * @return self
     */
    public function setTransferGUID($transferGUID)
    {
        $this->transferGUID = $transferGUID;
        return $this;
    }


}

