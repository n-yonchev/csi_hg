<?php

namespace ISSI;

/**
 * Class representing IncomingRegDetailsType
 *
 *
 * XSD Type: IncomingRegDetailsType
 */
class IncomingRegDetailsType
{

    /**
     * Входяща дата (датата на постъпване на документа в деловодството)
     *
     * @property \DateTime $regDate
     */
    private $regDate = null;

    /**
     * Входящ номер
     *
     * @property string $regNumber
     */
    private $regNumber = null;

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
     * Данни за подателя
     *
     * @property \ISSI\SubjectType $subject
     */
    private $subject = null;

    /**
     * Номенклатурни данни за начина на получаване на документа(с обратна разписка, препоръчано, по факс, по куриер, по електронна поща и др.)
     *
     * @property \ISSI\DeliveryType $delivery
     */
    private $delivery = null;

    /**
     * Код на вид на документа от номенклатурата на документите
     *
     * @property string $docSubCategoryCode
     */
    private $docSubCategoryCode = null;

    /**
     * Описание-свободен текст
     *
     * @property string $description
     */
    private $description = null;

    /**
     * Забележки-свободен текст
     *
     * @property string $notes
     */
    private $notes = null;

    /**
     * Gets as regDate
     *
     * Входяща дата (датата на постъпване на документа в деловодството)
     *
     * @return \DateTime
     */
    public function getRegDate()
    {
        return $this->regDate;
    }

    /**
     * Sets a new regDate
     *
     * Входяща дата (датата на постъпване на документа в деловодството)
     *
     * @param \DateTime $regDate
     * @return self
     */
    public function setRegDate(\DateTime $regDate)
    {
        $this->regDate = $regDate;
        return $this;
    }

    /**
     * Gets as regNumber
     *
     * Входящ номер
     *
     * @return string
     */
    public function getRegNumber()
    {
        return $this->regNumber;
    }

    /**
     * Sets a new regNumber
     *
     * Входящ номер
     *
     * @param string $regNumber
     * @return self
     */
    public function setRegNumber($regNumber)
    {
        $this->regNumber = $regNumber;
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
     * Gets as subject
     *
     * Данни за подателя
     *
     * @return \ISSI\SubjectType
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Sets a new subject
     *
     * Данни за подателя
     *
     * @param \ISSI\SubjectType $subject
     * @return self
     */
    public function setSubject(\ISSI\SubjectType $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Gets as delivery
     *
     * Номенклатурни данни за начина на получаване на документа(с обратна разписка, препоръчано, по факс, по куриер, по електронна поща и др.)
     *
     * @return \ISSI\DeliveryType
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Sets a new delivery
     *
     * Номенклатурни данни за начина на получаване на документа(с обратна разписка, препоръчано, по факс, по куриер, по електронна поща и др.)
     *
     * @param \ISSI\DeliveryType $delivery
     * @return self
     */
    public function setDelivery(\ISSI\DeliveryType $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * Gets as docSubCategoryCode
     *
     * Код на вид на документа от номенклатурата на документите
     *
     * @return string
     */
    public function getDocSubCategoryCode()
    {
        return $this->docSubCategoryCode;
    }

    /**
     * Sets a new docSubCategoryCode
     *
     * Код на вид на документа от номенклатурата на документите
     *
     * @param string $docSubCategoryCode
     * @return self
     */
    public function setDocSubCategoryCode($docSubCategoryCode)
    {
        $this->docSubCategoryCode = $docSubCategoryCode;
        return $this;
    }

    /**
     * Gets as description
     *
     * Описание-свободен текст
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
     * Описание-свободен текст
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
     * Забележки-свободен текст
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
     * Забележки-свободен текст
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

