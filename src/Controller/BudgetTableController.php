<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\PersonalBudgetItem;
use App\Repository\PersonalBudgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Request\HtmxRequest;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Template\TemplateBlock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BudgetTableController extends AbstractController
{
    use HtmxControllerTrait;

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
        return $this->render(
            'budget/base.html.twig',
        );
    }

    //    public function addBudgetItem(HtmxRequest $request)
    #[Route('/budget/item/add', name: "budget-item-add", methods: ['POST'])]
    public function addBudgetItem(Request $request)
    {
        $title = $request->request->get('budget-item-title', '');
        $amount = $request->request->get('budget-item-amount', 0);

        $budget = $this->personalBudgetRepository->find(1);
        $budgetItem = (new PersonalBudgetItem())
            ->setTitle($title)
            ->setAmount($amount)
            ->setBudgetId($budget)
        ;

        $this->entityManager->persist($budgetItem);
        $this->entityManager->flush();

        return $this->htmxRenderBlock(
            new TemplateBlock(
                'budget/components/budgetItem.html.twig',
                'budgetItem',
                ['budgetItem' => $budgetItem],
            ),
        );
    }

    #[Route('/budget/item/list', name: 'budget-items', methods: ['GET'])]
    public function getBudgetItems(HtmxRequest $request): HtmxResponse
    {
        $budget = $this->personalBudgetRepository->find(1);
        $budgetItems = $budget->getPersonalBudgetItem();
        return $this->htmxRenderBlock(
            new TemplateBlock(
                'budget/components/budgetItems.html.twig',
                'budgetItems',
                ['budgetItems' => $budgetItems],
            ),
        );
    }
}
