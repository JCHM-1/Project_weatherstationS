<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JoinTableProfileStation
 *
 * @ORM\Table(name="join_table_profile_station", indexes={@ORM\Index(name="profile_id", columns={"profile_id"}), @ORM\Index(name="station_id", columns={"station_id"})})
 * @ORM\Entity
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
    private $id;

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


}
