<?php

namespace App\Entity;

use App\Enum\WeaponType;
use App\Repository\WeaponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeaponRepository::class)]
class Weapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $value = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $accuracy = null;

    #[ORM\Column]
    private ?int $recoil = null;

    #[ORM\Column]
    private ?int $reload = null;

    #[ORM\Column]
    private ?int $hipshot = null;

    #[ORM\Column]
    private ?int $magazine = null;

    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\Column(enumType: WeaponType::class)]
    private ?WeaponType $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getAccuracy(): ?int
    {
        return $this->accuracy;
    }

    public function setAccuracy(int $accuracy): static
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    public function getRecoil(): ?int
    {
        return $this->recoil;
    }

    public function setRecoil(int $recoil): static
    {
        $this->recoil = $recoil;

        return $this;
    }

    public function getReload(): ?int
    {
        return $this->reload;
    }

    public function setReload(int $reload): static
    {
        $this->reload = $reload;

        return $this;
    }

    public function getHipshot(): ?int
    {
        return $this->hipshot;
    }

    public function setHipshot(int $hipshot): static
    {
        $this->hipshot = $hipshot;

        return $this;
    }

    public function getMagazine(): ?int
    {
        return $this->magazine;
    }

    public function setMagazine(int $magazine): static
    {
        $this->magazine = $magazine;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getType(): ?WeaponType
    {
        return $this->type;
    }

    public function setType(WeaponType $type): static
    {
        $this->type = $type;

        return $this;
    }
}
