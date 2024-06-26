<?php

declare(strict_types=1);

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveResponder;

#[AsLiveComponent]
class BudgetLineItem
{
    use DefaultActionTrait;

    #[LiveProp]
    public int $key;

    #[LiveProp(writable: true)]
    public string $title;

    #[LiveProp(writable: true)]
    public float $amount;

    #[LiveAction]
    public function save(LiveResponder $responder): void
    {
//        $this->validate();

        $responder->emitUp('line_item:save', [
            'key' => $this->key,
            'title' => $this->title,
            'amount' => $this->amount,
        ]);
    }
}
