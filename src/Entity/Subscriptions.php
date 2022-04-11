<?php

namespace App\Entity;

use App\Repository\SubscriptionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubscriptionsRepository::class)
 */
class Subscriptions
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
    private $Amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Realtime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->Amount;
    }

    public function setAmount(int $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getRealtime(): ?bool
    {
        return $this->Realtime;
    }

    public function setRealtime(bool $Realtime): self
    {
        $this->Realtime = $Realtime;

        return $this;
    }
}
