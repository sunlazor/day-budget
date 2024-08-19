<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PersonalBudgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Request\HtmxRequest;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Template\TemplateBlock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/budget/items', name: 'budget-items')]
    public function getBudgetItems(HtmxRequest $request): HtmxResponse
    {
        $budget = $this->personalBudgetRepository->findAll();
        $budgetItems = ($budget[0])->getPersonalBudgetItem();
        return $this->htmxRenderBlock(
            new TemplateBlock(
                'budget/components/budgetItem.html.twig',
                'budgetItems',
                ['budgetItems' => $budgetItems],
            ),
        );
    }
}
