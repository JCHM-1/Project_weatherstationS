<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DataRepo;

/**
 * Data
 *
 * @ORM\Table(name="data", indexes={@ORM\Index(name="stn_idx", columns={"stn"})})
 * @ORM\Entity(repositoryClass=DataRepo::class)
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

    /**
     * @return float|null
     */
    public function getSlp(): ?float
    {
        return $this->slp;
    }

    /**
     * @param float|null $slp
     */
    public function setSlp(?float $slp): void
    {
        $this->slp = $slp;
    }

    /**
     * @return float|null
     */
    public function getVisib(): ?float
    {
        return $this->visib;
    }

    /**
     * @param float|null $visib
     */
    public function setVisib(?float $visib): void
    {
        $this->visib = $visib;
    }

    /**
     * @return float|null
     */
    public function getWdsp(): ?float
    {
        return $this->wdsp;
    }

    /**
     * @param float|null $wdsp
     */
    public function setWdsp(?float $wdsp): void
    {
        $this->wdsp = $wdsp;
    }

    /**
     * @return float|null
     */
    public function getPrcp(): ?float
    {
        return $this->prcp;
    }

    /**
     * @param float|null $prcp
     */
    public function setPrcp(?float $prcp): void
    {
        $this->prcp = $prcp;
    }

    /**
     * @return float|null
     */
    public function getSndp(): ?float
    {
        return $this->sndp;
    }

    /**
     * @param float|null $sndp
     */
    public function setSndp(?float $sndp): void
    {
        $this->sndp = $sndp;
    }

    /**
     * @return string|null
     */
    public function getFrshtt(): ?string
    {
        return $this->frshtt;
    }

    /**
     * @param string|null $frshtt
     */
    public function setFrshtt(?string $frshtt): void
    {
        $this->frshtt = $frshtt;
    }

    /**
     * @return float|null
     */
    public function getCldc(): ?float
    {
        return $this->cldc;
    }

    /**
     * @param float|null $cldc
     */
    public function setCldc(?float $cldc): void
    {
        $this->cldc = $cldc;
    }

    /**
     * @return int|null
     */
    public function getWnddir(): ?int
    {
        return $this->wnddir;
    }

    /**
     * @param int|null $wnddir
     */
    public function setWnddir(?int $wnddir): void
    {
        $this->wnddir = $wnddir;
    }
}