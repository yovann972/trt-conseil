<?php

namespace App\Controller\Admin;

use App\Entity\Applicants;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ApplicantsCrudController extends AbstractCrudController
{

    public const CV_BASE_PATH = 'uploads/cv';
    public const CV_UPLOAD_DIR = 'public/uploads/cv';


    public static function getEntityFqcn(): string
    {
        return Applicants::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            BooleanField::new('isVerify'),
            AssociationField::new('createdBy'),
            ImageField::new('cv')->setUploadedFileNamePattern('[year]/[month]/[day]/[slug]-[contenthash].[extension]')
            ->setBasePath(self::CV_BASE_PATH)
            ->setUploadDir(self::CV_UPLOAD_DIR),
          
        ];
    }

    
}
