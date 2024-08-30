<?php

namespace App\Twig\Components;

use App\Entity\PersonalBudget;


class Budget
{
    /**
     * Contain:
     * - title: название траты/поступления
     * - amount: суммы траты/поступления
     */
    public array $lineItems;

    public PersonalBudget $budget;

    public function saveLineItem(int $key, string $title, float $amount): void
    {
        if (!isset($this->lineItems[$key])) {
            // shouldn't happen
            return;
        }

        $this->lineItems[$key]['title'] = $title;
        $this->lineItems[$key]['amount'] = $amount;
    }

    public function addLineItem(): void
    {
        $this->lineItems[] = [
            'title' => '', // название траты/поступления
            'amount' => 0, // суммы траты/поступления
        ];
    }


    /**
     * Общая итоговая сумма расходов и доходов.
     */
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->lineItems as $line) {
            $total += $line['amount'];
        }

        return $total;
    }

}
