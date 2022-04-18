<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Data
 *
 * @ORM\Table(name="data", indexes={@ORM\Index(name="stn_idx", columns={"stn"})})
 * @ORM\Entity
 */
class Data
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="time", type="time", nullable=true)
     */
    private $time;

    /**
     * @var float|null
     *
     * @ORM\Column(name="temp", type="float", precision=10, scale=0, nullable=true)
     */
    private $temp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dewp", type="float", precision=10, scale=0, nullable=true)
     */
    private $dewp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="stp", type="float", precision=10, scale=0, nullable=true)
     */
    private $stp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="slp", type="float", precision=10, scale=0, nullable=true)
     */
    private $slp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="visib", type="float", precision=10, scale=0, nullable=true)
     */
    private $visib;

    /**
     * @var float|null
     *
     * @ORM\Column(name="wdsp", type="float", precision=10, scale=0, nullable=true)
     */
    private $wdsp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prcp", type="float", precision=10, scale=0, nullable=true)
     */
    private $prcp;

    /**
     * @var float|null
     *
     * @ORM\Column(name="sndp", type="float", precision=10, scale=0, nullable=true)
     */
    private $sndp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="frshtt", type="string", length=64, nullable=true)
     */
    private $frshtt;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cldc", type="float", precision=10, scale=0, nullable=true)
     */
    private $cldc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="wnddir", type="integer", nullable=true)
     */
    private $wnddir;

    /**
     * @var \Station
     *
     * @ORM\ManyToOne(targetEntity="Station")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stn", referencedColumnName="name")
     * })
     */
    private $stn;

    public function setStn(mixed $STN)
    {
    }


}
