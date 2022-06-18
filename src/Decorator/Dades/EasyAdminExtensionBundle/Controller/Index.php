<?php

namespace Dades\FosUserExtensionBundle\Decorator\Dades\EasyAdminExtensionBundle\Controller;

use Dades\FosUserExtensionBundle\Security\Admin\Voter\HomePageVoter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Dades\EasyAdminExtensionBundle\Controller\Admin\Index as BaseIndex;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;

class Index extends AbstractDashboardController
{
    public function __construct(private BaseIndex $indexController)
    {
    }

    public function index(): Response
    {
        $this->denyAccessUnlessGranted(HomePageVoter::HOMEPAGE);

        return $this->indexController->index();
    }

    public function configureDashboard(): Dashboard
    {
        return $this->indexController->configureDashboard();
    }

    /**
     * @inheritdoc
     */
    public function configureMenuItems(): iterable
    {
        return $this->indexController->configureMenuItems();
    }
}
