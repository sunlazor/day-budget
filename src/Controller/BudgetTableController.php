<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\PersonalBudget;
use App\Entity\PersonalBudgetItem;
use App\Form\BudgetTableForm;
use App\Repository\PersonalBudgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BudgetTableController extends AbstractController
{
    private PersonalBudgetRepository $personalBudgetRepository;

    private EntityManagerInterface $entityManager;
    public function __construct(
        PersonalBudgetRepository $personalBudgetRepository,
        EntityManagerInterface $entityManager,
    ) {
        $this->personalBudgetRepository = $personalBudgetRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/budget', name: 'budget')]
    public function index(Request $request): Response
    {
        $budget = new PersonalBudget();
        $budget->setOwner('Vasya');
        $budget->addPersonalBudgetItem(
            (new PersonalBudgetItem())
                ->setTitle('first hello')
                ->setAmount(100.01)
        );
        $this->entityManager->persist($budget);
        $this->entityManager->flush();

        $readBudget = $this->personalBudgetRepository->find(1);
        $items = $readBudget->getPersonalBudgetItem();


        $form = $this->createForm(BudgetTableForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
//            dump($request);
//            $form
//                ->add('title', TextType::class, ['required' => false])
//            ;

            return $this->redirectToRoute('budget');
        }
        return $this->render(
            'budget/base.html.twig',
//            ['form' => $form->createView()],
            ['budgetItems' => $items],
        );
    }
}
