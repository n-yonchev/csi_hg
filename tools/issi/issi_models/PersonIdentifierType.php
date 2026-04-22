<?php

namespace ISSI;

/**
 * Class representing PersonIdentifierType
 *
 * Идентификатор на физическо лице
 * XSD Type: PersonIdentifier
 */
class PersonIdentifierType
{

    /**
     * @property string $eGN
     */
    private $eGN = null;

    /**
     * @property string $lNCh
     */
    private $lNCh = null;

    /**
     * Gets as eGN
     *
     * @return string
     */
    public function getEGN()
    {
        return $this->eGN;
    }

    /**
     * Sets a new eGN
     *
     * @param string $eGN
     * @return self
     */
    public function setEGN($eGN)
    {
        $this->eGN = $eGN;
        return $this;
    }

    /**
     * Gets as lNCh
     *
     * @return string
     */
    public function getLNCh()
    {
        return $this->lNCh;
    }

    /**
     * Sets a new lNCh
     *
     * @param string $lNCh
     * @return self
     */
    public function setLNCh($lNCh)
    {
        $this->lNCh = $lNCh;
        return $this;
    }


}

