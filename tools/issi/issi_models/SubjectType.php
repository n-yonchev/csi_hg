<?php

namespace ISSI;

/**
 * Class representing SubjectType
 *
 * Тип субект
 * XSD Type: SubjectType
 */
class SubjectType
{

    /**
     * @property \ISSI\PersonBasicDataType $person
     */
    private $person = null;

    /**
     * @property \ISSI\EntityBasicDataType $entity
     */
    private $entity = null;

    /**
     * @property \ISSI\ForeignCitizenBasicDataType $foreignPerson
     */
    private $foreignPerson = null;

    /**
     * @property \ISSI\ForeignEntityBasicDataType $foreignEntity
     */
    private $foreignEntity = null;

    /**
     * Gets as person
     *
     * @return \ISSI\PersonBasicDataType
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Sets a new person
     *
     * @param \ISSI\PersonBasicDataType $person
     * @return self
     */
    public function setPerson(\ISSI\PersonBasicDataType $person)
    {
        $this->person = $person;
        return $this;
    }

    /**
     * Gets as entity
     *
     * @return \ISSI\EntityBasicDataType
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Sets a new entity
     *
     * @param \ISSI\EntityBasicDataType $entity
     * @return self
     */
    public function setEntity(\ISSI\EntityBasicDataType $entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /**
     * Gets as foreignPerson
     *
     * @return \ISSI\ForeignCitizenBasicDataType
     */
    public function getForeignPerson()
    {
        return $this->foreignPerson;
    }

    /**
     * Sets a new foreignPerson
     *
     * @param \ISSI\ForeignCitizenBasicDataType $foreignPerson
     * @return self
     */
    public function setForeignPerson(\ISSI\ForeignCitizenBasicDataType $foreignPerson)
    {
        $this->foreignPerson = $foreignPerson;
        return $this;
    }

    /**
     * Gets as foreignEntity
     *
     * @return \ISSI\ForeignEntityBasicDataType
     */
    public function getForeignEntity()
    {
        return $this->foreignEntity;
    }

    /**
     * Sets a new foreignEntity
     *
     * @param \ISSI\ForeignEntityBasicDataType $foreignEntity
     * @return self
     */
    public function setForeignEntity(\ISSI\ForeignEntityBasicDataType $foreignEntity)
    {
        $this->foreignEntity = $foreignEntity;
        return $this;
    }


}

