<?php

namespace App\Controller\Admin;

use App\Entity\Recuiters;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class RecuitersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recuiters::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('companyName'),
            TextField::new('address'),
            TextField::new('city'),
            BooleanField::new('isVerify'),
            AssociationField::new('createdBy'),
            CollectionField::new('myOffers')
        ];
    }
    

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Recuiters) return;


        parent::persistEntity($em, $entityInstance);

    }

}
