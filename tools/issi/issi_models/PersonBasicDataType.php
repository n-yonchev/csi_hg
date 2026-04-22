<?php

namespace ISSI;

/**
 * Class representing PersonBasicDataType
 *
 * Основни данни за физическо лице
 * XSD Type: PersonBasicData
 */
class PersonBasicDataType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \ISSI\PersonIdentifierType $identifier
     */
    private $identifier = null;

    /**
     * @property string $address
     */
    private $address = null;

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as identifier
     *
     * @return \ISSI\PersonIdentifierType
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets a new identifier
     *
     * @param \ISSI\PersonIdentifierType $identifier
     * @return self
     */
    public function setIdentifier(\ISSI\PersonIdentifierType $identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Gets as address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets a new address
     *
     * @param string $address
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }


}

