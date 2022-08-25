<?php

namespace App\Controller\Admin;

use App\Entity\Applicants;
use App\Entity\JobsOffers;
use App\Entity\Recuiters;
use App\Entity\Users;
use App\Entity\Apply;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    public function __construct( 
        private AdminUrlGenerator $adminUrlGenerator)
    {     
    }

    #[Route('/admin', name:'admin')]
    public function index(): Response
    {
        //return parent::index();
        
        $url = $this->adminUrlGenerator
        ->setController(UsersCrudController::class)
        ->generateUrl();
        
        return $this->redirect($url);
    }
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('TRTConseil');
    }
    
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        /*
            Exemple Menu Item with yield:
            yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        */


        //Users Menu in dashboard
        yield MenuItem::subMenu('Utilisateurs', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter un utilisateur', 'fa fa-plus', Users::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les utilisateurs', 'fa fa-eye', Users::class)

        ]);

        //Recuiters Menu in dashboard
        yield MenuItem::subMenu('Recruteurs', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter un Recruteur', 'fa fa-plus', Recuiters::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les recruteurs', 'fa fa-eye', Recuiters::class)

        ]);

        //Applicants Menu in dashboard
        yield MenuItem::subMenu('Candidats', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter un Candidat', 'fa fa-plus', Applicants::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les candidat', 'fa fa-eye', Applicants::class)

        ]);
        
        //Jobs Offer Menu in dashboard
        yield MenuItem::subMenu('Les offres d\'emploi', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter une offre', 'fa fa-plus', JobsOffers::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les offres', 'fa fa-eye', JobsOffers::class)

        ]);             
        
        //Apply Menu in dashboard
        yield MenuItem::subMenu('Candidature', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter une candidature', 'fa fa-plus', Apply::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les candidatures', 'fa fa-eye', Apply::class)

        ]);     
        

    }
}
