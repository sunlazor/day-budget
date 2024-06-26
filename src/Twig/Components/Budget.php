<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveListener;


#[AsLiveComponent()]
class Budget
{
    use DefaultActionTrait;

    /**
     * Contain:
     * - title: название траты/поступления
     * - amount: суммы траты/поступления
     */
    #[LiveProp]
    public array $lineItems = [];

    #[LiveListener('line_item:save')]
    public function saveLineItem(#[LiveArg] int $key, #[LiveArg] string $title, #[LiveArg] float $amount): void
    {
        if (!isset($this->lineItems[$key])) {
            // shouldn't happen
            return;
        }

        $this->lineItems[$key]['title'] = $title;
        $this->lineItems[$key]['amount'] = $amount;
    }

    #[LiveAction]
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
