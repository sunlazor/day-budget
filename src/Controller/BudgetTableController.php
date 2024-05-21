<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\BudgetTableForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BudgetTableController extends AbstractController
{
    #[Route('/budget')]
    public function index(): Response
    {
        $form = $this->createForm(BudgetTableForm::class);
        return $this->render(
            'budget/base.html.twig',
            ['form' => $form->createView()],
        );
    }
}
