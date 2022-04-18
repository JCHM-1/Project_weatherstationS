<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JoinTableProfileStation
 *
 * @ORM\Table(name="join_table_profile_station", indexes={@ORM\Index(name="profile_id", columns={"profile_id"}), @ORM\Index(name="station_id", columns={"station_id"})})
 * @ORM\Entity(repositoryClass=JoinTableProfileStationRepo::class)
 */
class JoinTableProfileStation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $prim_id;

    /**
     * @var \Profile
     *
     * @ORM\ManyToOne(targetEntity="Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     * })
     */
    private $profile;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="station_id", referencedColumnName="name")
     * })
     */
    private $station;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }


}