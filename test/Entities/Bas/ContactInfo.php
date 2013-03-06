<?php

namespace Entities\Bas;

use Entities\Bas\BaseEntity as BaseEntity,
    Doctrine\Common\Collections\ArrayCollection,
    Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Bas\ContactInfo
 *
 * @ORM\Table(name="contact_info")
 * @ORM\Entity
 */
class ContactInfo {
    /**
     * @var integer $contact_info_id
     *
     * @ORM\Column(name="contact_info_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $contactInfoId;

    /**
     * @var string $first_name
     *
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    protected $firstName;

    /**
     * @var string $last_name
     *
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    protected $lastName;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;

    /**
     * @var integer $zip
     *
     * @ORM\Column(name="zip", type="integer", nullable=true)
     */
    protected $zip;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;

    /**
     * @var string $overseas
     *
     * @ORM\Column(name="overseas", type="string", nullable=true, columnDefinition="ENUM('yes','no','not answered')")
     */
    protected $overseas;

    /**
     * @ORM\OneToOne(targetEntity="Entities\Bas\FinancialInfo", mappedBy="contactInfo", cascade={"persist", "remove"})
     */
    protected $financialInfo;

    /**
     * @ORM\OneToOne(targetEntity="Entities\Bas\Cities", mappedBy="cityId", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     */
    protected $cities;

    /**
     * @ORM\OneToMany(targetEntity="Entities\Bas\PhoneNumbers", mappedBy="contactInfo", cascade={"persist", "remove"})
     *
     */
    protected $phoneNumbers;


    public function __construct() {
        $this->address      = 'no address';
        $this->overseas     = 'not answered';
        $this->phoneNumbers = new ArrayCollection();
    }

    public function setContactInfoId($contactInfoId) {
        $this->contactInfoId = $contactInfoId;
    }

    public function getContactInfoId() {
        return $this->contactInfoId;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }

    public function getZip() {
        return $this->zip;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setOverseas($overseas) {
        $this->overseas = $overseas;
    }

    public function getOverseas() {
        return $this->overseas;
    }

    public function setFinancialInfo($financialInfo) {
        $this->financialInfo = $financialInfo;    
    }

    public function getFinancialInfo() {
        return $this->financialInfo;    
    }

    public function setCities($cities) {
        $this->cities = $cities;
    }

    public function getCities() {
        return $this->cities;
    }

    public function setPhoneNUmbers($phoneNumbers) {
        $this->phoneNumbers = $phoneNumbers;
    } 

    public function getPhoneNumbers() {
        return $this->phoneNumbers;
    }

}