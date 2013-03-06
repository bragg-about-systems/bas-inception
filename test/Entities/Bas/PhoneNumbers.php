<?php
namespace Entities\Bas;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Bas\Cities
 *
 * @ORM\Table(name="phone_numbers")
 * @ORM\Entity
 */
class PhoneNumbers {
    /**
     * @var integer $phone_number_id
     *
     * @ORM\Column(name="phone_number_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $phoneNumberId;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Entities\Bas\ContactInfo", inversedBy="phoneNumbers", cascade={"ALL"})
     * @ORM\JoinColumn(name="contact_info_id", referencedColumnName="contact_info_id")
     */
    protected $contactInfo;

    /**
     * @var string $phoneNumberType
     *
     * @ORM\Column(name="phone_number_type", type="string", columnDefinition="ENUM('home','work','cell','fax','other','not given')", nullable=false)
     */
    protected $phoneNumberType;

    /**
     * @var string $phone_number
     *
     * @ORM\Column(name="phone_number", type="string", nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string $phone_order
     *
     * @ORM\Column(name="phone_order", type="string", columnDefinition="ENUM('primary','secondary','tertiary','na')")
     */
    protected $phoneOrder;

    /**
     * @var string $best_time
     *
     * @ORM\Column(name="best_time", type="string", columnDefinition="ENUM('morning','afternoon','evening','anytime','not given')")
     */
    protected $bestTime;

    /**
     * @var integer $good_number
     *
     * @ORM\Column(name="good_number", type="integer", nullable=true)
     */
    protected $goodNumber;

    public function __construct() {
        $this->phoneNumber     = 1;
        $this->phoneNumberType = 'not given';
        $this->phoneOrder      = 'primary';
        $this->bestTime        = 'not given';
        $this->goodNumber      = 1;
    }

    public function setPhoneNumberId($phoneNumberId) {
        $this->phoneNumberId = $phoneNumberId;
    }

    public function getPhoneNumberId() {
        return $this->phoneNumberId;
    }

    public function setContactInfo($contactInfo) {
        $this->contactInfo = $contactInfo;
    }

    public function getContactInfo() {
        return $this->contactInfo;
    }

    public function setPhoneNumberType($phoneNumberType) {
        $this->phoneNumberType = $phoneNumberType;
    }

    public function getPhoneNumberType() {
        return $this->phoneNumberType;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneOrder($phoneOrder) {
        $this->phoneOrder = $phoneOrder;
    }

    public function getPhoneOrder() {
        return $this->phoneOrder;
    }

    public function setBestTime($bestTime) {
        $this->bestTime = $bestTime;
    }

    public function getBestTime() {
        return $this->bestTime;
    }

    public function setGoodNumber($goodNumber) {
        $this->goodNumber = $goodNumber;
    }

    public function getGoodNumber() {
        return $this->goodNumber;
    }
}