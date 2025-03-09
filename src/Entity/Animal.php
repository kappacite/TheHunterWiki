<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $class = null;

    #[ORM\Column]
    #[Assert\Range(min: 1, max: 9)]
    private ?int $maxDifficulty = null;

    /**
     * @var Collection<int, Reserve>
     */
    #[ORM\ManyToMany(targetEntity: Reserve::class, mappedBy: 'animals')]
    private Collection $reserves;

    public function __construct()
    {
        $this->reserves = new ArrayCollection();
    }

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

    public function getClass(): ?int
    {
        return $this->class;
    }

    public function setClass(int $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getMaxDifficulty(): ?int
    {
        return $this->maxDifficulty;
    }

    public function setMaxDifficulty(int $maxDifficulty): static
    {
        $this->maxDifficulty = $maxDifficulty;

        return $this;
    }

    /**
     * @return Collection<int, Reserve>
     */
    public function getReserves(): Collection
    {
        return $this->reserves;
    }

    public function addReserve(Reserve $reserve): static
    {
        if (!$this->reserves->contains($reserve)) {
            $this->reserves->add($reserve);
            $reserve->addAnimal($this);
        }

        return $this;
    }

    public function removeReserve(Reserve $reserve): static
    {
        if ($this->reserves->removeElement($reserve)) {
            $reserve->removeAnimal($this);
        }

        return $this;
    }
}
