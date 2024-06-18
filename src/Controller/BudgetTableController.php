<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\BudgetTableForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BudgetTableController extends AbstractController
{
    #[Route('/budget')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(BudgetTableForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
//            dump($request);
//            $form
//                ->add('title', TextType::class, ['required' => false])
//            ;

            return $this->redirectToRoute('');
        }
        return $this->render(
            'budget/base.html.twig',
            ['form' => $form->createView()],
        );
    }
}
