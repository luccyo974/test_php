<?php

namespace App\Entity;

use App\Repository\AdressesRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdressesRequestRepository::class)]
class AdressesRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $requestParams = null;

    #[ORM\Column(length: 255)]
    private ?string $requestIp = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestParams(): ?string
    {
        return $this->requestParams;
    }

    public function setRequestParams(string $requestParams): static
    {
        $this->requestParams = $requestParams;

        return $this;
    }

    public function getRequestIp(): ?string
    {
        return $this->requestIp;
    }

    public function setRequestIp(string $requestIp): static
    {
        $this->requestIp = $requestIp;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
