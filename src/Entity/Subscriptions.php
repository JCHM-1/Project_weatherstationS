<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscriptions
 *
 * @ORM\Table(name="subscriptions")
 * @ORM\Entity
 */
class Subscriptions
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
     * @var int
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var bool
     *
     * @ORM\Column(name="realtime", type="boolean", nullable=false)
     */
    private $realtime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;

    }

    public function getRealtime(): ?bool
    {
        return $this->realtime;
    }

    public function setRealtime(bool $realtime): self
    {
        $this->realtime = $realtime;

        return $this;
    }


}