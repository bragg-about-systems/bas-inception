<?php

namespace Entities\Bas;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Bas\FinancialInfo
 *
 * @ORM\Table(name="financial_info")
 * @ORM\Entity
 */
class FinancialInfo {
    /**
     * @var integer $financialInfoId
     *
     * @ORM\Column(name="financial_info_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $financialInfoId;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Entities\Bas\ContactInfo", inversedBy="financialInfo", cascade={"ALL"})
     * @ORM\JoinColumn(name="contact_info_id", referencedColumnName="contact_info_id")
     */
    protected $contactInfo;

    /**
     * @var string $creditRating
     *
     * @ORM\Column(name="credit_rating", type="string", nullable=false, columnDefinition="ENUM('Poor','Fair','Good','Excellent')")
     */
    protected $creditRating;

    /**
     * @var integer $grossIncome
     *
     * @ORM\Column(name="gross_income", type="integer", nullable=false)
     */
    protected $grossIncome;

    /**
     * @var string $bankruptcy
     *
     * @ORM\Column(name="bankruptcy", type="string", nullable=false, columnDefinition="ENUM('Never','Currently','12months','1year','2year','5year','7year','discharged')")
     */
    protected $bankruptcy;

    /**
     * @var integer $totalAssets
     *
     * @ORM\Column(name="total_assets", type="integer", nullable=false)
     */
    protected $totalAssets;

    /**
     * @var boolean $latePayments
     *
     * @ORM\Column(name="late_payments", type="boolean", nullable=false)
     */
    protected $latePayments;

    /**
     * @var integer $monthlyDebtPayment
     *
     * @ORM\Column(name="monthly_debt_payment", type="integer", nullable=false)
     */
    protected $monthlyDebtPayment;

    /**
     * @var float $currentRate
     *
     * @ORM\Column(name="current_rate", type="decimal", nullable=false)
     */
    protected $currentRate;

    /**
     * @var boolean $homeOwner
     *
     * @ORM\Column(name="home_owner", type="boolean", nullable=false)
     */
    protected $homeOwner;

    /**
     * @var string $occupationalStatus
     *
     * @ORM\Column(name="occupational_status", type="string", nullable=false, columnDefinition="ENUM('Employed','Self-Employed','Retired','Not-Employed')")
     */
    protected $occupationalStatus;

    /**
     * @var string $otherLatePayments
     *
     * @ORM\Column(name="other_late_payments", type="string", nullable=false, columnDefinition="ENUM('0','1-2','3 or more')")
     */
    protected $otherLatePayments;

    /**
     * @var string $denyReason
     *
     * @ORM\Column(name="deny_reason", type="string", nullable=false, columnDefinition="ENUM('not_denied','bk','dti','dco','jh','nijhq','other','foreclosure','other_bad','lates')")
     */
    protected $denyReason;

    /**
     * @var integer $denyNote
     *
     * @ORM\Column(name="deny_note", type="integer", nullable=false)
     */
    protected $denyNote;

    /**
     * @var boolean $mortgagePayments
     *
     * @ORM\Column(name="mortgage_payments", type="boolean", nullable=false)
     */
    protected $mortgagePayments;

    /**
     * @var integer $bIncome
     *
     * @ORM\Column(name="b_income", type="integer", nullable=false)
     */
    protected $bIncome;

    /**
     * @var integer $cbIncome
     *
     * @ORM\Column(name="cb_income", type="integer", nullable=false)
     */
    protected $cbIncome;

    /**
     * @var float $rateTrigger
     *
     * @ORM\Column(name="rate_trigger", type="decimal", nullable=false)
     */
    protected $rateTrigger;

    /**
     * @var string $pulledCredit
     *
     * @ORM\Column(name="pulled_credit", type="string", nullable=false, columnDefinition="ENUM('yes','no','unknown')")
     */
    protected $pulledCredit;

    /**
     * @var string $pulledCredit
     *
     * @ORM\Column(name="renting", type="integer", nullable=false)
     */
    protected $renting;

    public function __construct() {
        $this->creditRating       = 'Poor';
        $this->grossIncome        = 0;
        $this->bankruptcy         = 'Never';
        $this->totalAssets        = 0;
        $this->latePayments       = 0;
        $this->monthlyDebtPayment = 0;
        $this->currentRate        = 0.0000;
        $this->homeOwner          = 0;
        $this->occupationalStatus = 'Employed';
        $this->otherLatePayments  = 0;
        $this->denyReason         = 'not_denied';
        $this->denyNote           = 1;
        $this->mortgagePayments   = 0;
        $this->bIncome            = 0;
        $this->cbIncome           = 0;
        $this->rateTrigger        = 0.0000;
        $this->pulledCredit       = 'unknown';
        $this->renting            = 0;

    }

    /**
     * Get financialInfoId
     *
     * @return integer 
     */
    public function getFinancialInfoId()
    {
        return $this->financialInfoId;
    }

    /**
     * Set creditRating
     *
     * @param string $creditRating
     * @return FinancialInfo
     */
    public function setCreditRating($creditRating)
    {
        $this->creditRating = $creditRating;
    
        return $this;
    }

    /**
     * Get creditRating
     *
     * @return string 
     */
    public function getCreditRating()
    {
        return $this->creditRating;
    }

    /**
     * Set grossIncome
     *
     * @param integer $grossIncome
     * @return FinancialInfo
     */
    public function setGrossIncome($grossIncome)
    {
        $this->grossIncome = $grossIncome;
    
        return $this;
    }

    /**
     * Get grossIncome
     *
     * @return integer 
     */
    public function getGrossIncome()
    {
        return $this->grossIncome;
    }

    /**
     * Set bankruptcy
     *
     * @param string $bankruptcy
     * @return FinancialInfo
     */
    public function setBankruptcy($bankruptcy)
    {
        $this->bankruptcy = $bankruptcy;
    
        return $this;
    }

    /**
     * Get bankruptcy
     *
     * @return string 
     */
    public function getBankruptcy()
    {
        return $this->bankruptcy;
    }

    /**
     * Set totalAssets
     *
     * @param integer $totalAssets
     * @return FinancialInfo
     */
    public function setTotalAssets($totalAssets)
    {
        $this->totalAssets = $totalAssets;
    
        return $this;
    }

    /**
     * Get totalAssets
     *
     * @return integer 
     */
    public function getTotalAssets()
    {
        return $this->totalAssets;
    }

    /**
     * Set latePayments
     *
     * @param boolean $latePayments
     * @return FinancialInfo
     */
    public function setLatePayments($latePayments)
    {
        $this->latePayments = $latePayments;
    
        return $this;
    }

    /**
     * Get latePayments
     *
     * @return boolean 
     */
    public function getLatePayments()
    {
        return $this->latePayments;
    }

    /**
     * Set monthlyDebtPayment
     *
     * @param integer $monthlyDebtPayment
     * @return FinancialInfo
     */
    public function setMonthlyDebtPayment($monthlyDebtPayment)
    {
        $this->monthlyDebtPayment = $monthlyDebtPayment;
    
        return $this;
    }

    /**
     * Get monthlyDebtPayment
     *
     * @return integer 
     */
    public function getMonthlyDebtPayment()
    {
        return $this->monthlyDebtPayment;
    }

    /**
     * Set currentRate
     *
     * @param float $currentRate
     * @return FinancialInfo
     */
    public function setCurrentRate($currentRate)
    {
        $this->currentRate = $currentRate;
    
        return $this;
    }

    /**
     * Get currentRate
     *
     * @return float 
     */
    public function getCurrentRate()
    {
        return $this->currentRate;
    }

    /**
     * Set homeOwner
     *
     * @param boolean $homeOwner
     * @return FinancialInfo
     */
    public function setHomeOwner($homeOwner)
    {
        $this->homeOwner = $homeOwner;
    
        return $this;
    }

    /**
     * Get homeOwner
     *
     * @return boolean 
     */
    public function getHomeOwner()
    {
        return $this->homeOwner;
    }

    /**
     * Set occupationalStatus
     *
     * @param string $occupationalStatus
     * @return FinancialInfo
     */
    public function setOccupationalStatus($occupationalStatus)
    {
        $this->occupationalStatus = $occupationalStatus;
    
        return $this;
    }

    /**
     * Get occupationalStatus
     *
     * @return string 
     */
    public function getOccupationalStatus()
    {
        return $this->occupationalStatus;
    }

    /**
     * Set otherLatePayments
     *
     * @param string $otherLatePayments
     * @return FinancialInfo
     */
    public function setOtherLatePayments($otherLatePayments)
    {
        $this->otherLatePayments = $otherLatePayments;
    
        return $this;
    }

    /**
     * Get otherLatePayments
     *
     * @return string 
     */
    public function getOtherLatePayments()
    {
        return $this->otherLatePayments;
    }

    /**
     * Set denyReason
     *
     * @param string $denyReason
     * @return FinancialInfo
     */
    public function setDenyReason($denyReason)
    {
        $this->denyReason = $denyReason;
    
        return $this;
    }

    /**
     * Get denyReason
     *
     * @return string 
     */
    public function getDenyReason()
    {
        return $this->denyReason;
    }

    /**
     * Set denyNote
     *
     * @param integer $denyNote
     * @return FinancialInfo
     */
    public function setDenyNote($denyNote)
    {
        $this->denyNote = $denyNote;
    
        return $this;
    }

    /**
     * Get denyNote
     *
     * @return integer 
     */
    public function getDenyNote()
    {
        return $this->denyNote;
    }

    /**
     * Set mortgagePayments
     *
     * @param boolean $mortgagePayments
     * @return FinancialInfo
     */
    public function setMortgagePayments($mortgagePayments)
    {
        $this->mortgagePayments = $mortgagePayments;
    
        return $this;
    }

    /**
     * Get mortgagePayments
     *
     * @return boolean 
     */
    public function getMortgagePayments()
    {
        return $this->mortgagePayments;
    }

    /**
     * Set bIncome
     *
     * @param integer $bIncome
     * @return FinancialInfo
     */
    public function setBIncome($bIncome)
    {
        $this->bIncome = $bIncome;
    
        return $this;
    }

    /**
     * Get bIncome
     *
     * @return integer 
     */
    public function getBIncome()
    {
        return $this->bIncome;
    }

    /**
     * Set cbIncome
     *
     * @param integer $cbIncome
     * @return FinancialInfo
     */
    public function setCbIncome($cbIncome)
    {
        $this->cbIncome = $cbIncome;
    
        return $this;
    }

    /**
     * Get cbIncome
     *
     * @return integer 
     */
    public function getCbIncome()
    {
        return $this->cbIncome;
    }

    /**
     * Set rateTrigger
     *
     * @param float $rateTrigger
     * @return FinancialInfo
     */
    public function setRateTrigger($rateTrigger)
    {
        $this->rateTrigger = $rateTrigger;
    
        return $this;
    }

    /**
     * Get rateTrigger
     *
     * @return float 
     */
    public function getRateTrigger()
    {
        return $this->rateTrigger;
    }

    /**
     * Set pulledCredit
     *
     * @param string $pulledCredit
     * @return FinancialInfo
     */
    public function setPulledCredit($pulledCredit)
    {
        $this->pulledCredit = $pulledCredit;
    
        return $this;
    }

    /**
     * Get pulledCredit
     *
     * @return string 
     */
    public function getPulledCredit()
    {
        return $this->pulledCredit;
    }

    /**
     * Set renting
     *
     * @param integer $renting
     * @return FinancialInfo
     */
    public function setRenting($renting)
    {
        $this->renting = $renting;
    
        return $this;
    }

    /**
     * Get renting
     *
     * @return integer 
     */
    public function getRenting()
    {
        return $this->renting;
    }

    /**
     * Set contactInfo
     *
     * @param \Entities\Bas\ContactInfo $contactInfo
     * @return FinancialInfo
     */
    public function setContactInfo($contactInfo)
    {
        $this->contactInfo = $contactInfo;
    
        return $this;
    }

    /**
     * Get contactInfo
     *
     * @return \Entities\Bas\ContactInfo 
     */
    public function getContactInfo()
    {
        return $this->contactInfo;
    }

}