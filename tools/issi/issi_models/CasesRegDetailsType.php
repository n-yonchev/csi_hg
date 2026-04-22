<?php

namespace ISSI;

/**
 * Class representing CasesRegDetailsType
 *
 *
 * XSD Type: CasesRegDetailsType
 */
class CasesRegDetailsType
{

    /**
     * Номер на изпълнително дело
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
     * Входящ номер
     *
     * @property string $regNumber
     */
    private $regNumber = null;

    /**
     * Входяща дата (датата на постъпване на документа в деловодството)
     *
     * @property \DateTime $regDate
     */
    private $regDate = null;

    /**
     * попълва се наименованието на съда и номерът на делото, по което е издаден изпълнителният лист, съответно заповедта
     *
     * @property string $courtCase
     */
    private $courtCase = null;

    /**
     * попълва се името на частния съдебен изпълнител така, както е вписано в регистъра на частните съдебни изпълнители
     *
     * @property string $agentName
     */
    private $agentName = null;

    /**
     * попълва се регистрационният номер на частния съдебен изпълнител, под който е вписан в регистъра на частните съдебни изпълнители
     *
     * @property string $agentRegNum
     */
    private $agentRegNum = null;

    /**
     * Попълват се: името (наименованието), ЕГН (ЕИК/БУЛСТАТ) и адрес (седалище) на взискателя
     *
     * @property \ISSI\SubjectType $creditor
     */
    private $creditor = null;

    /**
     * попълват се: името (наименованието), ЕГН (ЕИК/БУЛСТАТ) и адрес (седалище) на длъжника
     *
     * @property \ISSI\SubjectType $debtor
     */
    private $debtor = null;

    /**
     * попълва се списък с допълнителни взискатели ако съществуват
     *
     * @property \ISSI\AdditionalCreditorsDetailsType[] $additionalCreditors
     */
    private $additionalCreditors = null;

    /**
     * попълва се списък с допълнителни длъжници ако съществуват
     *
     * @property \ISSI\AdditionalDebtorsDetailsType[] $additionalDebtors
     */
    private $additionalDebtors = null;

    /**
     * номенклатурни данни за вида на вземането
     *
     * @property int $debtType
     */
    private $debtType = null;

    /**
     * попълва се размера на вземането
     *
     * @property float $debt
     */
    private $debt = null;

    /**
     * Описание на вземането
     *
     * @property string $debtDescription
     */
    private $debtDescription = null;

    /**
     * Описание на произхода на вземането
     *
     * @property string $debtOrigin
     */
    private $debtOrigin = null;

    /**
     * Дата на спиране на изпълнителното производство
     *
     * @property \DateTime $stopedDate
     */
    private $stopedDate = null;

    /**
     * Дата на възобновяване на изпълнителното производство
     *
     * @property \DateTime $resumedDate
     */
    private $resumedDate = null;

    /**
     * Дата на свършване на изпълнителното производство
     *
     * @property \DateTime $terminationDate
     */
    private $terminationDate = null;

    /**
     * Дата на изпращане на делото на друг съдебен изпълнител
     *
     * @property \DateTime $transferredDate
     */
    private $transferredDate = null;

    /**
     * Описание - свободен текст
     *
     * @property string $description
     */
    private $description = null;

    /**
     * Забележки - свободен текст
     *
     * @property string $notes
     */
    private $notes = null;

    /**
     * Регистрационен номер на частния съдебен изпълнител до който е изпратено делото
     *
     * @property string $transferredToEAgentRegNum
     */
    private $transferredToEAgentRegNum = null;

    /**
     * Името на частния съдебен изпълнител до който е изпратено делото
     *
     * @property string $transferredToEAgentName
     */
    private $transferredToEAgentName = null;

    /**
     * Gets as caseNum
     *
     * Номер на изпълнително дело
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
     * Номер на изпълнително дело
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
     * Gets as courtCase
     *
     * попълва се наименованието на съда и номерът на делото, по което е издаден изпълнителният лист, съответно заповедта
     *
     * @return string
     */
    public function getCourtCase()
    {
        return $this->courtCase;
    }

    /**
     * Sets a new courtCase
     *
     * попълва се наименованието на съда и номерът на делото, по което е издаден изпълнителният лист, съответно заповедта
     *
     * @param string $courtCase
     * @return self
     */
    public function setCourtCase($courtCase)
    {
        $this->courtCase = $courtCase;
        return $this;
    }

    /**
     * Gets as agentName
     *
     * попълва се името на частния съдебен изпълнител така, както е вписано в регистъра на частните съдебни изпълнители
     *
     * @return string
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * Sets a new agentName
     *
     * попълва се името на частния съдебен изпълнител така, както е вписано в регистъра на частните съдебни изпълнители
     *
     * @param string $agentName
     * @return self
     */
    public function setAgentName($agentName)
    {
        $this->agentName = $agentName;
        return $this;
    }

    /**
     * Gets as agentRegNum
     *
     * попълва се регистрационният номер на частния съдебен изпълнител, под който е вписан в регистъра на частните съдебни изпълнители
     *
     * @return string
     */
    public function getAgentRegNum()
    {
        return $this->agentRegNum;
    }

    /**
     * Sets a new agentRegNum
     *
     * попълва се регистрационният номер на частния съдебен изпълнител, под който е вписан в регистъра на частните съдебни изпълнители
     *
     * @param string $agentRegNum
     * @return self
     */
    public function setAgentRegNum($agentRegNum)
    {
        $this->agentRegNum = $agentRegNum;
        return $this;
    }

    /**
     * Gets as creditor
     *
     * Попълват се: името (наименованието), ЕГН (ЕИК/БУЛСТАТ) и адрес (седалище) на взискателя
     *
     * @return \ISSI\SubjectType
     */
    public function getCreditor()
    {
        return $this->creditor;
    }

    /**
     * Sets a new creditor
     *
     * Попълват се: името (наименованието), ЕГН (ЕИК/БУЛСТАТ) и адрес (седалище) на взискателя
     *
     * @param \ISSI\SubjectType $creditor
     * @return self
     */
    public function setCreditor(\ISSI\SubjectType $creditor)
    {
        $this->creditor = $creditor;
        return $this;
    }

    /**
     * Gets as debtor
     *
     * попълват се: името (наименованието), ЕГН (ЕИК/БУЛСТАТ) и адрес (седалище) на длъжника
     *
     * @return \ISSI\SubjectType
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * Sets a new debtor
     *
     * попълват се: името (наименованието), ЕГН (ЕИК/БУЛСТАТ) и адрес (седалище) на длъжника
     *
     * @param \ISSI\SubjectType $debtor
     * @return self
     */
    public function setDebtor(\ISSI\SubjectType $debtor)
    {
        $this->debtor = $debtor;
        return $this;
    }

    /**
     * Adds as additionalCreditorsDetails
     *
     * попълва се списък с допълнителни взискатели ако съществуват
     *
     * @return self
     * @param \ISSI\AdditionalCreditorsDetailsType $additionalCreditorsDetails
     */
    public function addToAdditionalCreditors(\ISSI\AdditionalCreditorsDetailsType $additionalCreditorsDetails)
    {
        $this->additionalCreditors[] = $additionalCreditorsDetails;
        return $this;
    }

    /**
     * isset additionalCreditors
     *
     * попълва се списък с допълнителни взискатели ако съществуват
     *
     * @param int|string $index
     * @return bool
     */
    public function issetAdditionalCreditors($index)
    {
        return isset($this->additionalCreditors[$index]);
    }

    /**
     * unset additionalCreditors
     *
     * попълва се списък с допълнителни взискатели ако съществуват
     *
     * @param int|string $index
     * @return void
     */
    public function unsetAdditionalCreditors($index)
    {
        unset($this->additionalCreditors[$index]);
    }

    /**
     * Gets as additionalCreditors
     *
     * попълва се списък с допълнителни взискатели ако съществуват
     *
     * @return \ISSI\AdditionalCreditorsDetailsType[]
     */
    public function getAdditionalCreditors()
    {
        return $this->additionalCreditors;
    }

    /**
     * Sets a new additionalCreditors
     *
     * попълва се списък с допълнителни взискатели ако съществуват
     *
     * @param \ISSI\AdditionalCreditorsDetailsType[] $additionalCreditors
     * @return self
     */
    public function setAdditionalCreditors(array $additionalCreditors)
    {
        $this->additionalCreditors = $additionalCreditors;
        return $this;
    }

    /**
     * Adds as additionalDebtorsDetails
     *
     * попълва се списък с допълнителни длъжници ако съществуват
     *
     * @return self
     * @param \ISSI\AdditionalDebtorsDetailsType $additionalDebtorsDetails
     */
    public function addToAdditionalDebtors(\ISSI\AdditionalDebtorsDetailsType $additionalDebtorsDetails)
    {
        $this->additionalDebtors[] = $additionalDebtorsDetails;
        return $this;
    }

    /**
     * isset additionalDebtors
     *
     * попълва се списък с допълнителни длъжници ако съществуват
     *
     * @param int|string $index
     * @return bool
     */
    public function issetAdditionalDebtors($index)
    {
        return isset($this->additionalDebtors[$index]);
    }

    /**
     * unset additionalDebtors
     *
     * попълва се списък с допълнителни длъжници ако съществуват
     *
     * @param int|string $index
     * @return void
     */
    public function unsetAdditionalDebtors($index)
    {
        unset($this->additionalDebtors[$index]);
    }

    /**
     * Gets as additionalDebtors
     *
     * попълва се списък с допълнителни длъжници ако съществуват
     *
     * @return \ISSI\AdditionalDebtorsDetailsType[]
     */
    public function getAdditionalDebtors()
    {
        return $this->additionalDebtors;
    }

    /**
     * Sets a new additionalDebtors
     *
     * попълва се списък с допълнителни длъжници ако съществуват
     *
     * @param \ISSI\AdditionalDebtorsDetailsType[] $additionalDebtors
     * @return self
     */
    public function setAdditionalDebtors(array $additionalDebtors)
    {
        $this->additionalDebtors = $additionalDebtors;
        return $this;
    }

    /**
     * Gets as debtType
     *
     * номенклатурни данни за вида на вземането
     *
     * @return int
     */
    public function getDebtType()
    {
        return $this->debtType;
    }

    /**
     * Sets a new debtType
     *
     * номенклатурни данни за вида на вземането
     *
     * @param int $debtType
     * @return self
     */
    public function setDebtType($debtType)
    {
        $this->debtType = $debtType;
        return $this;
    }

    /**
     * Gets as debt
     *
     * попълва се размера на вземането
     *
     * @return float
     */
    public function getDebt()
    {
        return $this->debt;
    }

    /**
     * Sets a new debt
     *
     * попълва се размера на вземането
     *
     * @param float $debt
     * @return self
     */
    public function setDebt($debt)
    {
        $this->debt = $debt;
        return $this;
    }

    /**
     * Gets as debtDescription
     *
     * Описание на вземането
     *
     * @return string
     */
    public function getDebtDescription()
    {
        return $this->debtDescription;
    }

    /**
     * Sets a new debtDescription
     *
     * Описание на вземането
     *
     * @param string $debtDescription
     * @return self
     */
    public function setDebtDescription($debtDescription)
    {
        $this->debtDescription = $debtDescription;
        return $this;
    }

    /**
     * Gets as debtOrigin
     *
     * Описание на произхода на вземането
     *
     * @return string
     */
    public function getDebtOrigin()
    {
        return $this->debtOrigin;
    }

    /**
     * Sets a new debtOrigin
     *
     * Описание на произхода на вземането
     *
     * @param string $debtOrigin
     * @return self
     */
    public function setDebtOrigin($debtOrigin)
    {
        $this->debtOrigin = $debtOrigin;
        return $this;
    }

    /**
     * Gets as stopedDate
     *
     * Дата на спиране на изпълнителното производство
     *
     * @return \DateTime
     */
    public function getStopedDate()
    {
        return $this->stopedDate;
    }

    /**
     * Sets a new stopedDate
     *
     * Дата на спиране на изпълнителното производство
     *
     * @param \DateTime $stopedDate
     * @return self
     */
    public function setStopedDate(\DateTime $stopedDate)
    {
        $this->stopedDate = $stopedDate;
        return $this;
    }

    /**
     * Gets as resumedDate
     *
     * Дата на възобновяване на изпълнителното производство
     *
     * @return \DateTime
     */
    public function getResumedDate()
    {
        return $this->resumedDate;
    }

    /**
     * Sets a new resumedDate
     *
     * Дата на възобновяване на изпълнителното производство
     *
     * @param \DateTime $resumedDate
     * @return self
     */
    public function setResumedDate(\DateTime $resumedDate)
    {
        $this->resumedDate = $resumedDate;
        return $this;
    }

    /**
     * Gets as terminationDate
     *
     * Дата на свършване на изпълнителното производство
     *
     * @return \DateTime
     */
    public function getTerminationDate()
    {
        return $this->terminationDate;
    }

    /**
     * Sets a new terminationDate
     *
     * Дата на свършване на изпълнителното производство
     *
     * @param \DateTime $terminationDate
     * @return self
     */
    public function setTerminationDate(\DateTime $terminationDate)
    {
        $this->terminationDate = $terminationDate;
        return $this;
    }

    /**
     * Gets as transferredDate
     *
     * Дата на изпращане на делото на друг съдебен изпълнител
     *
     * @return \DateTime
     */
    public function getTransferredDate()
    {
        return $this->transferredDate;
    }

    /**
     * Sets a new transferredDate
     *
     * Дата на изпращане на делото на друг съдебен изпълнител
     *
     * @param \DateTime $transferredDate
     * @return self
     */
    public function setTransferredDate(\DateTime $transferredDate)
    {
        $this->transferredDate = $transferredDate;
        return $this;
    }

    /**
     * Gets as description
     *
     * Описание - свободен текст
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
     * Описание - свободен текст
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
     * Забележки - свободен текст
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
     * Забележки - свободен текст
     *
     * @param string $notes
     * @return self
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * Gets as transferredToEAgentRegNum
     *
     * Регистрационен номер на частния съдебен изпълнител до който е изпратено делото
     *
     * @return string
     */
    public function getTransferredToEAgentRegNum()
    {
        return $this->transferredToEAgentRegNum;
    }

    /**
     * Sets a new transferredToEAgentRegNum
     *
     * Регистрационен номер на частния съдебен изпълнител до който е изпратено делото
     *
     * @param string $transferredToEAgentRegNum
     * @return self
     */
    public function setTransferredToEAgentRegNum($transferredToEAgentRegNum)
    {
        $this->transferredToEAgentRegNum = $transferredToEAgentRegNum;
        return $this;
    }

    /**
     * Gets as transferredToEAgentName
     *
     * Името на частния съдебен изпълнител до който е изпратено делото
     *
     * @return string
     */
    public function getTransferredToEAgentName()
    {
        return $this->transferredToEAgentName;
    }

    /**
     * Sets a new transferredToEAgentName
     *
     * Името на частния съдебен изпълнител до който е изпратено делото
     *
     * @param string $transferredToEAgentName
     * @return self
     */
    public function setTransferredToEAgentName($transferredToEAgentName)
    {
        $this->transferredToEAgentName = $transferredToEAgentName;
        return $this;
    }


}

