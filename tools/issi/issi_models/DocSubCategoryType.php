<?php

namespace ISSI;

/**
 * Class representing DocSubCategoryType
 *
 * Вид документ от номенклатура на документите в ИССИ
 * XSD Type: DocSubCategoryType
 */
class DocSubCategoryType
{

    /**
     * Уникален номер на документ от номенклатура на документите в ИССИ. Съдържа стойността на колона № от приложенията към Наредбата
     *
     * @property string $docSubCategoryCode
     */
    private $docSubCategoryCode = null;

    /**
     * Уникален номер на категория документ.
     *
     * @property string $docCategoryCode
     */
    private $docCategoryCode = null;

    /**
     * Наименование на вида документ от номенклатурата на документите в ИССИ
     *
     * @property string $docSubCategoryName
     */
    private $docSubCategoryName = null;

    /**
     * Gets as docSubCategoryCode
     *
     * Уникален номер на документ от номенклатура на документите в ИССИ. Съдържа стойността на колона № от приложенията към Наредбата
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
     * Уникален номер на документ от номенклатура на документите в ИССИ. Съдържа стойността на колона № от приложенията към Наредбата
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
     * Gets as docCategoryCode
     *
     * Уникален номер на категория документ.
     *
     * @return string
     */
    public function getDocCategoryCode()
    {
        return $this->docCategoryCode;
    }

    /**
     * Sets a new docCategoryCode
     *
     * Уникален номер на категория документ.
     *
     * @param string $docCategoryCode
     * @return self
     */
    public function setDocCategoryCode($docCategoryCode)
    {
        $this->docCategoryCode = $docCategoryCode;
        return $this;
    }

    /**
     * Gets as docSubCategoryName
     *
     * Наименование на вида документ от номенклатурата на документите в ИССИ
     *
     * @return string
     */
    public function getDocSubCategoryName()
    {
        return $this->docSubCategoryName;
    }

    /**
     * Sets a new docSubCategoryName
     *
     * Наименование на вида документ от номенклатурата на документите в ИССИ
     *
     * @param string $docSubCategoryName
     * @return self
     */
    public function setDocSubCategoryName($docSubCategoryName)
    {
        $this->docSubCategoryName = $docSubCategoryName;
        return $this;
    }


}

