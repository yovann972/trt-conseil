<?php

namespace App\Controller\Admin;

use App\Entity\JobsOffers;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class JobsOffersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobsOffers::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('authorId'),
            TextField::new('title'),
            TextField::new('address'),
            TextField::new('city'),
            TextField::new('zipCode'),
            TextField::new('description'),
            BooleanField::new('isActive'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),

        ];
    }
    
}
