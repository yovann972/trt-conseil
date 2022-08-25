<?php

namespace App\Controller;

use App\Entity\Applicants;
use App\Form\ApplicantsType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApplicantsController extends AbstractController
{
    /**
     * @param $slugger
     * @param $request
     * @param $entityManagerInterface
     * @return form
     * 
     */
    #[Route('/candidat/formulaire', name: 'app_applicants_form')]
    public function newApplicant( SluggerInterface $slugger, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $applicant = new Applicants();

        $form = $this->createForm(ApplicantsType::class, $applicant);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $applicant->setCreatedBy($this->getUser());
             
            $cvFile = $form->get('PDF')->getData();

            // this condition is needed because the 'cv' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($cvFile) {
                $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$cvFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $cvFile->move(
                        $this->getParameter('cv_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $applicant->setCv($newFilename);

                $applicant = $form->getData();

                $entityManagerInterface->persist($applicant);
                $entityManagerInterface->flush();

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
            }


            return $this->redirectToRoute('app_applicant_profil',['id'=> $applicant->getId()]);
        }
        

        return $this->renderForm('applicants/index.html.twig', [
            'form' => $form
        ]);
    }

    /**
    * Afficher la liste des candidats
    * @param  $doctrine
    *
    * @return array 
    */

    #[Route('/candidat', name: 'app_applicants')]
    public function apllicantsList( ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getManager()->getRepository(Applicants::class);
        $applicants = $repository->findAll();   

        $applicant = $repository->findOneBy(['createdBy' => $this->getUser()]);

        return $this->render('applicants/ApplicantsList.html.twig', [
            'applicants' => $applicants,
            'applicant' => $applicant
        ]);
    }

    /**
     * @param {id} — $applicant
     * 
     * @param $doctrine
     * @param mixed $applicant
     * @return object $aplicant
     */

    #[Route('/candidat/{id}', name: 'app_applicant_profil')]
    #[ParamConverter(
        'applicant',
        class: Applicants::class,
        options: ['id' => 'id'], 
    )]
    public function viewApplicant(ManagerRegistry $doctrine, $applicant): Response
    {
        
        if($this->getUser() !== $applicant->getCreatedBy())
        {
           throw $this->createNotFoundException('Vous n\'avez pas accès à ce compte');

        } else {

            return $this->render('applicants/view.html.twig', compact('applicant'));

        }

    }



}   
