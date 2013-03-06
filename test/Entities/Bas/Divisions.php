<?php

namespace Entities\Vamclo;

use Entities\BaseEntity as BaseEntity,
    Doctrine\ORM\Mapping as ORM;

/**
 * Entities\Vamclo\Divisions
 *
 * @ORM\Table(name="divisions")
 * @ORM\Entity
 */
class Divisions extends BaseEntity {
    /**
     * @var boolean $divisionId
     *
     * @ORM\Column(name="division_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $divisionId;

    /**
     * @var string $divisionName
     *
     * @ORM\Column(name="division_name", type="string", length=50, nullable=true)
     */
    protected $divisionName;

    /**
     * @var string $phoneNumber
     *
     * @ORM\Column(name="phone_number", type="string", length=18, nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string $divisionCity
     *
     * @ORM\Column(name="division_city", type="string", length=50, nullable=true)
     */
    protected $divisionCity;

    /**
     * @var boolean $dsaExempt
     *
     * @ORM\Column(name="dsa_exempt", type="boolean", nullable=true)
     */
    protected $dsaExempt;

    /**
     * @var integer $priorityLevel
     *
     * @ORM\Column(name="priority_level", type="integer", nullable=true)
     */
    protected $priorityLevel;

    /**
     * @var boolean $pal
     *
     * @ORM\Column(name="pal", type="boolean", nullable=true)
     */
    protected $pal;

    /**
     * @var string $nmlsId
     *
     * @ORM\Column(name="nmls_id", type="string", length=15, nullable=true)
     */
    protected $nmlsId;

    /**
     * @var string $divisionLo
     *
     * @ORM\Column(name="division_lo", type="string", length=60, nullable=true)
     */
    protected $divisionLo;

    /**
     * @var string $divisionLoEmail
     *
     * @ORM\Column(name="division_lo_email", type="string", length=60, nullable=true)
     */
    protected $divisionLoEmail;

    /**
     * @var string $displayName
     *
     * @ORM\Column(name="display_name", type="string", length=50, nullable=true)
     */
    protected $displayName;

    /**
     * @var string $companyName
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     */
    protected $companyName;

    public function __construct() {
        parent::__construct(__NAMESPACE__ . '\Divisions');

    }

    public function getSkip() {
        return array();
    }

}
