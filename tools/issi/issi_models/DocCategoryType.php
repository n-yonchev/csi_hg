<?php

namespace ISSI;

/**
 * Class representing DocCategoryType
 *
 * Категория документ
 * XSD Type: DocCategoryType
 */
class DocCategoryType
{

    /**
     * Уникален номер на категория документ.
     *
     * @property string $code
     */
    private $code = null;

    /**
     * Тип на документа. Описанието на този тип се намира в схема CommonType.xsd
     *
     * @property int $docTypeId
     */
    private $docTypeId = null;

    /**
     * Наименование на категория документ
     *
     * @property string $docCategoryName
     */
    private $docCategoryName = null;

    /**
     * Gets as code
     *
     * Уникален номер на категория документ.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets a new code
     *
     * Уникален номер на категория документ.
     *
     * @param string $code
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Gets as docTypeId
     *
     * Тип на документа. Описанието на този тип се намира в схема CommonType.xsd
     *
     * @return int
     */
    public function getDocTypeId()
    {
        return $this->docTypeId;
    }

    /**
     * Sets a new docTypeId
     *
     * Тип на документа. Описанието на този тип се намира в схема CommonType.xsd
     *
     * @param int $docTypeId
     * @return self
     */
    public function setDocTypeId($docTypeId)
    {
        $this->docTypeId = $docTypeId;
        return $this;
    }

    /**
     * Gets as docCategoryName
     *
     * Наименование на категория документ
     *
     * @return string
     */
    public function getDocCategoryName()
    {
        return $this->docCategoryName;
    }

    /**
     * Sets a new docCategoryName
     *
     * Наименование на категория документ
     *
     * @param string $docCategoryName
     * @return self
     */
    public function setDocCategoryName($docCategoryName)
    {
        $this->docCategoryName = $docCategoryName;
        return $this;
    }


}

