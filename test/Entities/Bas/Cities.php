<?php

namespace Entities\Bas;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Bas\Cities
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity
 */
class Cities {
    /**
     * @var integer $city_id
     *
     * @ORM\Column(name="city_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $cityId;

    /**
     * @var string $city_name
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $cityName;

    /**
     * @var string $county
     *
     * @ORM\Column(name="county", type="string", nullable=true)
     */
    protected $county;

    /**
     * @var integer $county_id
     *
     * @ORM\Column(name="county_id", type="integer", nullable=true)
     */
    protected $countyId;

    /**
     * @var integer $latitude
     *
     * @ORM\Column(name="latitude", type="integer", nullable=true)
     */
    protected $latitude;

    /**
     * @var integer $longitude
     *
     * @ORM\Column(name="longitude", type="integer", nullable=true)
     */
    protected $longitude;

    public function __construct() {
        
    }

    public function setCityId($cityId) {
        $this->cityId = $cityId;
    }

    public function getCityId() {
        return $this->cityId;
    }

    public function setCityName($cityName) {
        $this->cityName = $cityName;
    }

    public function setCounty($county) {
        $this->county = $county;
    }

    public function setCountyId($countyId) {
        $this->countyId = $countyId;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
}