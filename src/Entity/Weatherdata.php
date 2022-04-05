<?php

namespace App\Entity;

use App\Repository\WeatherdataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeatherdataRepository::class)
 */
class Weatherdata
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
    private $stn;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="float")
     */
    private $temp;

    /**
     * @ORM\Column(type="float")
     */
    private $dewp;

    /**
     * @ORM\Column(type="float")
     */
    private $stp;

    /**
     * @ORM\Column(type="float")
     */
    private $slp;

    /**
     * @ORM\Column(type="float")
     */
    private $visib;

    /**
     * @ORM\Column(type="float")
     */
    private $wdsp;

    /**
     * @ORM\Column(type="float")
     */
    private $prcp;

    /**
     * @ORM\Column(type="float")
     */
    private $sndp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frshtt;

    /**
     * @ORM\Column(type="float")
     */
    private $cldc;

    /**
     * @ORM\Column(type="integer")
     */
    private $wnddir;

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

    public function getDate(): \DateTimeInterface
    {

        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getDewp(): ?float
    {
        return $this->dewp;
    }

    public function setDewp(float $dewp): self
    {
        $this->dewp = $dewp;

        return $this;
    }

    public function getStp(): ?float
    {
        return $this->stp;
    }

    public function setStp(float $stp): self
    {
        $this->stp = $stp;

        return $this;
    }

    public function getSlp(): ?float
    {
        return $this->slp;
    }

    public function setSlp(float $slp): self
    {
        $this->slp = $slp;

        return $this;
    }

    public function getVisib(): ?float
    {
        return $this->visib;
    }

    public function setVisib(float $visib): self
    {
        $this->visib = $visib;

        return $this;
    }

    public function getWdsp(): ?float
    {
        return $this->wdsp;
    }

    public function setWdsp(float $wdsp): self
    {
        $this->wdsp = $wdsp;

        return $this;
    }

    public function getPrcp(): ?float
    {
        return $this->prcp;
    }

    public function setPrcp(float $prcp): self
    {
        $this->prcp = $prcp;

        return $this;
    }

    public function getSndp(): ?float
    {
        return $this->sndp;
    }

    public function setSndp(float $sndp): self
    {
        $this->sndp = $sndp;

        return $this;
    }

    public function getFrshtt(): ?string
    {
        return $this->frshtt;
    }

    public function setFrshtt(string $frshtt): self
    {
        $this->frshtt = $frshtt;

        return $this;
    }

    public function getCldc(): ?float
    {
        return $this->cldc;
    }

    public function setCldc(float $cldc): self
    {
        $this->cldc = $cldc;

        return $this;
    }

    public function getWnddir(): ?int
    {
        return $this->wnddir;
    }

    public function setWnddir(int $wnddir): self
    {
        $this->wnddir = $wnddir;

        return $this;
    }
}
