<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    private $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //dd($this->user->findByPaysGroup());
        return $this->render('admin/dashboard.html.twig', [
            'users' => $this->user->findByPaysGroup()
        ]);
    }

    public function configureDashboard(): Dashboard
    {

        return Dashboard::new()
            ->setTitle('Geolocation App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-circle', User::class)->setDefaultSort(['pays' => 'ASC']);
    }


}
