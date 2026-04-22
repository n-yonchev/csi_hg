<?php

namespace ISSI;

/**
 * Class representing ActionRegDetailsType
 *
 *
 * XSD Type: ActionRegDetailsType
 */
class ActionRegDetailsType
{

    /**
     * Дата и час на извършено действие.
     *
     * @property \DateTime $actionDate
     */
    private $actionDate = null;

    /**
     * Пореден номер на извършено действие в дневника.
     *
     * @property string $actionNumber
     */
    private $actionNumber = null;

    /**
     * Номер на изпълнителното дело, по което постъпва входираният документ. В случай че документът не е по конкретно дело, се попълва "друго".
     *
     * @property string $caseNum
     */
    private $caseNum = null;

    /**
     * Дата на изпълнителното дело
     *
     * @property \DateTime $caseDate
     */
    private $caseDate = null;

    /**
     * Данни за лице
     *
     * @property \ISSI\SubjectType $liableSubject
     */
    private $liableSubject = null;

    /**
     * Номенклатурен код за извършено действие(commonType.xsd)
     *
     * @property int $actionTypeID
     */
    private $actionTypeID = null;

    /**
     * Описание на извършеното действие
     *
     * @property string $description
     */
    private $description = null;

    /**
     * Забележки за извършеното действие
     *
     * @property string $notes
     */
    private $notes = null;

    /**
     * Gets as actionDate
     *
     * Дата и час на извършено действие.
     *
     * @return \DateTime
     */
    public function getActionDate()
    {
        return $this->actionDate;
    }

    /**
     * Sets a new actionDate
     *
     * Дата и час на извършено действие.
     *
     * @param \DateTime $actionDate
     * @return self
     */
    public function setActionDate(\DateTime $actionDate)
    {
        $this->actionDate = $actionDate;
        return $this;
    }

    /**
     * Gets as actionNumber
     *
     * Пореден номер на извършено действие в дневника.
     *
     * @return string
     */
    public function getActionNumber()
    {
        return $this->actionNumber;
    }

    /**
     * Sets a new actionNumber
     *
     * Пореден номер на извършено действие в дневника.
     *
     * @param string $actionNumber
     * @return self
     */
    public function setActionNumber($actionNumber)
    {
        $this->actionNumber = $actionNumber;
        return $this;
    }

    /**
     * Gets as caseNum
     *
     * Номер на изпълнителното дело, по което постъпва входираният документ. В случай че документът не е по конкретно дело, се попълва "друго".
     *
     * @return string
     */
    public function getCaseNum()
    {
        return $this->caseNum;
    }

    /**
     * Sets a new caseNum
     *
     * Номер на изпълнителното дело, по което постъпва входираният документ. В случай че документът не е по конкретно дело, се попълва "друго".
     *
     * @param string $caseNum
     * @return self
     */
    public function setCaseNum($caseNum)
    {
        $this->caseNum = $caseNum;
        return $this;
    }

    /**
     * Gets as caseDate
     *
     * Дата на изпълнителното дело
     *
     * @return \DateTime
     */
    public function getCaseDate()
    {
        return $this->caseDate;
    }

    /**
     * Sets a new caseDate
     *
     * Дата на изпълнителното дело
     *
     * @param \DateTime $caseDate
     * @return self
     */
    public function setCaseDate(\DateTime $caseDate)
    {
        $this->caseDate = $caseDate;
        return $this;
    }

    /**
     * Gets as liableSubject
     *
     * Данни за лице
     *
     * @return \ISSI\SubjectType
     */
    public function getLiableSubject()
    {
        return $this->liableSubject;
    }

    /**
     * Sets a new liableSubject
     *
     * Данни за лице
     *
     * @param \ISSI\SubjectType $liableSubject
     * @return self
     */
    public function setLiableSubject(\ISSI\SubjectType $liableSubject)
    {
        $this->liableSubject = $liableSubject;
        return $this;
    }

    /**
     * Gets as actionTypeID
     *
     * Номенклатурен код за извършено действие(commonType.xsd)
     *
     * @return int
     */
    public function getActionTypeID()
    {
        return $this->actionTypeID;
    }

    /**
     * Sets a new actionTypeID
     *
     * Номенклатурен код за извършено действие(commonType.xsd)
     *
     * @param int $actionTypeID
     * @return self
     */
    public function setActionTypeID($actionTypeID)
    {
        $this->actionTypeID = $actionTypeID;
        return $this;
    }

    /**
     * Gets as description
     *
     * Описание на извършеното действие
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * Описание на извършеното действие
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as notes
     *
     * Забележки за извършеното действие
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Sets a new notes
     *
     * Забележки за извършеното действие
     *
     * @param string $notes
     * @return self
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }


}

