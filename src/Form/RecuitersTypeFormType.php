<?php

namespace App\Form;

use App\Entity\Recuiters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecuitersTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyName', TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'required' => true,
                'label'=>'Nom de l\'entreprise'
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label'=>'Adresse'
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label'=>'Ville'
            ])
            ->add('zipCode', TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ],
                'label'=>'Code Postal'
            ])
            // ->add('isVerify')
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'form-control my-2 btn btn-primary',
                ],
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recuiters::class,
        ]);
    }
}
