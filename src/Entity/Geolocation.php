<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Geolocation
 *
 * @ORM\Table(name="geolocation", indexes={@ORM\Index(name="country_code", columns={"country_code"}), @ORM\Index(name="fk_station_name_idx", columns={"station_name"})})
 * @ORM\Entity
 */
class Geolocation
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
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=2, nullable=false)
     */
    private $countryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="island", type="string", length=100, nullable=true)
     */
    private $island;

    /**
     * @var string|null
     *
     * @ORM\Column(name="county", type="string", length=100, nullable=true)
     */
    private $county;

    /**
     * @var string|null
     *
     * @ORM\Column(name="place", type="string", length=100, nullable=true)
     */
    private $place;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hamlet", type="string", length=100, nullable=true)
     */
    private $hamlet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="town", type="string", length=100, nullable=true)
     */
    private $town;

    /**
     * @var string|null
     *
     * @ORM\Column(name="municipality", type="string", length=100, nullable=true)
     */
    private $municipality;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state_district", type="string", length=100, nullable=true)
     */
    private $stateDistrict;

    /**
     * @var string|null
     *
     * @ORM\Column(name="administrative", type="string", length=100, nullable=true)
     */
    private $administrative;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=100, nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="village", type="string", length=100, nullable=true)
     */
    private $village;

    /**
     * @var string|null
     *
     * @ORM\Column(name="region", type="string", length=100, nullable=true)
     */
    private $region;

    /**
     * @var string|null
     *
     * @ORM\Column(name="province", type="string", length=100, nullable=true)
     */
    private $province;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="locality", type="string", length=100, nullable=true)
     */
    private $locality;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postcode", type="string", length=100, nullable=true)
     */
    private $postcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;

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
