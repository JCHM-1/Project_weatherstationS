<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\NLrepo;

/**
 * Nearestlocation
 *
 * @ORM\Table(name="nearestlocation", indexes={@ORM\Index(name="fk_nearestlocation_country_code", columns={"country_code"}), @ORM\Index(name="station_name_idx", columns={"station_name"})})
 * @ORM\Entity(repositoryClass="App\Repository\NLrepo")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdministrativeRegion1(): ?string
    {
        return $this->administrativeRegion1;
    }

    public function setAdministrativeRegion1(?string $administrativeRegion1): self
    {
        $this->administrativeRegion1 = $administrativeRegion1;

        return $this;
    }

    public function getAdministrativeRegion2(): ?string
    {
        return $this->administrativeRegion2;
    }

    public function setAdministrativeRegion2(?string $administrativeRegion2): self
    {
        $this->administrativeRegion2 = $administrativeRegion2;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getCountryCode(): ?Country
    {
        return $this->countryCode;
    }

    public function setCountryCode(?Country $countryCode): self
    {
        $this->countryCode = $countryCode;

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
