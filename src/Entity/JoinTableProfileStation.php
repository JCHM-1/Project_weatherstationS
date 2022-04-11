<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JoinTableProfileStation
 *
 * @ORM\Table(name="join_table_profile_station", indexes={@ORM\Index(name="station_id_idx", columns={"station_id"})})
 * @ORM\Entity
 */
class JoinTableProfileStation
{
    /**
     * @var int
     *
     * @ORM\Column(name="profile_id", type="integer", nullable=false)
     */
    private $profileId;

    /**
     * @var \Profile
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="station_id", referencedColumnName="name")
     * })
     */
    private $station;


}
