<?php

namespace App\Entity;

use App\Repository\JoinTableProfileStationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoinTableProfileStationRepository::class)
 */
class JoinTableProfileStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Profile_ID;

    /**
     * @ORM\Column(type="integer")
     */
    private $station_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfileID(): ?int
    {
        return $this->Profile_ID;
    }

    public function setProfileID(int $Profile_ID): self
    {
        $this->Profile_ID = $Profile_ID;

        return $this;
    }

    public function getStationId(): ?int
    {
        return $this->station_id;
    }

    public function setStationId(int $station_id): self
    {
        $this->station_id = $station_id;

        return $this;
    }
}
