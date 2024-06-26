<?php

namespace App\Entity;

use App\Repository\PersonalBudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalBudgetRepository::class)]
class PersonalBudget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $owner = null;

    /**
     * @var Collection<int, PersonalBudgetItem>
     */
    #[ORM\OneToMany(targetEntity: PersonalBudgetItem::class, mappedBy: 'budgetId', cascade: ['persist'], orphanRemoval: true)]
    private Collection $personalBudgetItem;

    public function __construct()
    {
        $this->personalBudgetItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, PersonalBudgetItem>
     */
    public function getPersonalBudgetItem(): Collection
    {
        return $this->personalBudgetItem;
    }

    public function addPersonalBudgetItem(PersonalBudgetItem $personalBudgetItem): static
    {
        if (!$this->personalBudgetItem->contains($personalBudgetItem)) {
            $this->personalBudgetItem->add($personalBudgetItem);
            $personalBudgetItem->setBudgetId($this);
        }

        return $this;
    }

    public function removePersonalBudgetItem(PersonalBudgetItem $personalBudgetItem): static
    {
        if ($this->personalBudgetItem->removeElement($personalBudgetItem)) {
            // set the owning side to null (unless already changed)
            if ($personalBudgetItem->getBudgetId() === $this) {
                $personalBudgetItem->setBudgetId(null);
            }
        }

        return $this;
    }
}
