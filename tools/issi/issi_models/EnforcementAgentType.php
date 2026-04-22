<?php

namespace ISSI;

/**
 * Class representing EnforcementAgentType
 *
 * Съдебен изпълнител
 * XSD Type: EnforcementAgentType
 */
class EnforcementAgentType
{

    /**
     * Регистрационен номер на съдебен изпълнител
     *
     * @property string $enforcementAgentRegNum
     */
    private $enforcementAgentRegNum = null;

    /**
     * Трите имена на съдебния изпълнител
     *
     * @property string $enforcementAgentName
     */
    private $enforcementAgentName = null;

    /**
     * Gets as enforcementAgentRegNum
     *
     * Регистрационен номер на съдебен изпълнител
     *
     * @return string
     */
    public function getEnforcementAgentRegNum()
    {
        return $this->enforcementAgentRegNum;
    }

    /**
     * Sets a new enforcementAgentRegNum
     *
     * Регистрационен номер на съдебен изпълнител
     *
     * @param string $enforcementAgentRegNum
     * @return self
     */
    public function setEnforcementAgentRegNum($enforcementAgentRegNum)
    {
        $this->enforcementAgentRegNum = $enforcementAgentRegNum;
        return $this;
    }

    /**
     * Gets as enforcementAgentName
     *
     * Трите имена на съдебния изпълнител
     *
     * @return string
     */
    public function getEnforcementAgentName()
    {
        return $this->enforcementAgentName;
    }

    /**
     * Sets a new enforcementAgentName
     *
     * Трите имена на съдебния изпълнител
АЦ     *
     * @param string $enforcementAgentName
     * @return self
     */
    public function setEnforcementAgentName($enforcementAgentName)
    {
        $this->enforcementAgentName = $enforcementAgentName;
        return $this;
    }


}

