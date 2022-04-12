<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nearestlocation
 *
 * @ORM\Table(name="nearestlocation", indexes={@ORM\Index(name="fk_nearestlocation_country_code", columns={"country_code"}), @ORM\Index(name="station_name_idx", columns={"station_name"})})
 * @ORM\Entity
 */
class Nearestlocation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="administrative_region1", type="string", length=100, nullable=true)
     */
    private $administrativeRegion1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="administrative_region2", type="string", length=100, nullable=true)
     */
    private $administrativeRegion2;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $longitude;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=false)
     */
    private $latitude;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_code", referencedColumnName="country_code")
     * })
     */
    private $countryCode;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="station_name", referencedColumnName="name")
     * })
     */
    private $stationName;


}
