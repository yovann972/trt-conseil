<?php

namespace App\Controller;

use App\Entity\Recuiters;
use App\Form\RecuitersTypeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use function PHPUnit\Framework\throwException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RecuitersController extends AbstractController
{   
    
    #[Route('/recruteur/formulaire', name: 'app_recuiter_form')]    
    /**
     * new
     *
     * @param  mixed $request
     * @param  mixed $entityManagerInterface
     * @return Response
     */
    public function new( Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $recuiter = new Recuiters();

        $form = $this->createForm(RecuitersTypeFormType::class, $recuiter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $recuiter->setCreatedBy($this->getUser());
            // $form->getData() holds the submitted values

            // but, the original `$task` variable has also been updated
            $recuiter = $form->getData();

    
            $entityManagerInterface->persist($recuiter);
            $entityManagerInterface->flush();


            return $this->redirectToRoute('app_recuiter_view', ['id'=> $recuiter->getId()]);
        }

        return $this->renderForm('recuiter_form/index.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/recruteur', name: 'app_recuiter')]    
    /**
     * recuiterList
     *
     * @param  mixed $doctrine
     * @return Response
     */
    public function recuiterList(ManagerRegistry $doctrine): Response
    {

       $repository = $doctrine->getManager()->getRepository(Recuiters::class);
       $recuiters = $repository->findAll();
       $recuiter = $repository->findOneBy(['createdBy'=> $this->getUser()]);

       return $this->render('Recuiters/recuiterList.html.twig', [
        'recuiters' => $recuiters,
        'recuiter' => $recuiter
    ]);
    }


    #[Route('/recruteur/{id}', name:'app_recuiter_view')]
    #[ParamConverter(
        'recuiter',
        class: Recuiters::class,
        options: ['id' => 'id'], 
    )]    
    /**
     * view
     *
     * @param  mixed $request
     * @return object 
     */
    public function view(Request $request,
     Recuiters $recuiter, ManagerRegistry $doctrine): Response
    {


        if($this->getUser() !== $recuiter->getCreatedBy()){
            throw $this->createNotFoundException('Vous n\'avez pas accès à ce compte');
        }

       return $this->render('Recuiters/view.html.twig', compact('recuiter'));
    }



}
