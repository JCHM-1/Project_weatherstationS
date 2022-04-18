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
     * @ORM\Column(type="integer")
     */
    private $stn;

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
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStn(): ?int
    {
        return $this->stn;
    }

    public function setStn(int $stn): self
    {
        $this->stn = $stn;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(?float $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getDewp(): ?float
    {
        return $this->dewp;
    }

    public function setDewp(?float $dewp): self
    {
        $this->dewp = $dewp;

        return $this;
    }

    public function getStp(): ?float
    {
        return $this->stp;
    }

    public function setStp(?float $stp): self
    {
        $this->stp = $stp;

        return $this;
    }


}
