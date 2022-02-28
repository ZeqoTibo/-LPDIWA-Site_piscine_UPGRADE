<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Devis;
use App\Entity\User;
use App\Entity\UserAdmin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LPDIWA Site Piscine');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section("Client"),
            MenuItem::linkToCrud("Liste des clients", 'fa fa-user', Client::class),
            MenuItem::section("Devis"),
            MenuItem::linkToCrud("Liste des devis", 'fa fa-calculator', Devis::class),
            MenuItem::section("Administrateur"),
            MenuItem::linkToCrud("Comptes admin", 'fa fa-lock', User::class),
        ];


    }
    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return UserMenu::new()
            // use the given $user object to get the user name
            ->setName($user->getUserIdentifier())
            // use this method if you don't want to display the name of the user
            ->displayUserName(false)

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                MenuItem::linkToRoute('Mon profile', 'fa fa-id-card', '...', ['...' => '...']),
                MenuItem::linkToRoute('Paramètre', 'fa fa-user-cog', '...', ['...' => '...']),
                MenuItem::section(),
                MenuItem::linkToLogout('Deconnexion', 'fa fa-sign-out'),
            ]);
    }


}
