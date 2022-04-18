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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getIsland(): ?string
    {
        return $this->island;
    }

    public function setIsland(?string $island): self
    {
        $this->island = $island;

        return $this;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function setCounty(?string $county): self
    {
        $this->county = $county;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getHamlet(): ?string
    {
        return $this->hamlet;
    }

    public function setHamlet(?string $hamlet): self
    {
        $this->hamlet = $hamlet;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getMunicipality(): ?string
    {
        return $this->municipality;
    }

    public function setMunicipality(?string $municipality): self
    {
        $this->municipality = $municipality;

        return $this;
    }

    public function getStateDistrict(): ?string
    {
        return $this->stateDistrict;
    }

    public function setStateDistrict(?string $stateDistrict): self
    {
        $this->stateDistrict = $stateDistrict;

        return $this;
    }

    public function getAdministrative(): ?string
    {
        return $this->administrative;
    }

    public function setAdministrative(?string $administrative): self
    {
        $this->administrative = $administrative;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getVillage(): ?string
    {
        return $this->village;
    }

    public function setVillage(?string $village): self
    {
        $this->village = $village;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(?string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getStationName(): ?Station
    {
        return $this->stationName;
    }

    public function setStationName(?Station $stationName): self
    {
        $this->stationName = $stationName;

        return $this;
    }


}
