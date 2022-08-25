<?php

namespace App\Form;

use App\Entity\Applicants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApplicantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom'
            ])
            ->add('PDF', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Cv format (PDF)',
                'mapped' => false,
                'required' => true,
                'constraints'=> [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Merci de transmettre un PDF valide'
                ])]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'form-control my-2 btn btn-primary',
                ],
                'label' => 'Enregistrer'
            ])
        ;

            // ->add('isVerify')
            // ->add('UserId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Applicants::class,
        ]);
    }
}
