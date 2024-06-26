<?php

namespace App\Entity;

use App\Repository\PersonalBudgetItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalBudgetItemRepository::class)]
class PersonalBudgetItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PersonalBudget::class, cascade: ['persist', 'remove'], inversedBy: 'personalBudgetItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PersonalBudget $budgetId = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?float $amount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBudgetId(): ?PersonalBudget
    {
        return $this->budgetId;
    }

    public function setBudgetId(?PersonalBudget $budgetId): static
    {
        $this->budgetId = $budgetId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
