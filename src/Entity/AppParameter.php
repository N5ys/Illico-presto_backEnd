<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AppParameterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppParameterRepository::class)]
#[ApiResource]
class AppParameter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $interdishDelay = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInterdishDelay(): ?int
    {
        return $this->interdishDelay;
    }

    public function setInterdishDelay(int $interdishDelay): static
    {
        $this->interdishDelay = $interdishDelay;

        return $this;
    }
}
