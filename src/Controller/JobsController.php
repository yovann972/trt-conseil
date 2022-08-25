<?php

namespace App\Controller;

use App\Entity\Apply;
use App\Entity\Users;
use App\Form\ApplyType;
use App\Entity\Recuiters;
use App\Entity\Applicants;
use App\Entity\JobsOffers;
use Symfony\Component\Mime\Email;
use App\Repository\ApplicantsRepository;
use App\Repository\JobsOffersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobsController extends AbstractController
{


    #[Route('/offres', name: 'app_jobs')]    
    /**
     * jobList
     *
     * @param  mixed $doctrine
     * @param  mixed $repo
     * @return Aray
     */
    public function jobList(ManagerRegistry $doctrine, JobsOffersRepository $repo): Response
    {
        $repository = $doctrine->getManager()->getRepository(Recuiters::class);
        $recuiter = $repository->findOneBy(['createdBy'=>$this->getUser()]);

        $repositoryApplicant = $doctrine->getManager()->getRepository(Applicants::class);
        $applicant= $repositoryApplicant->findOneBy(['createdBy' => $this->getUser()]);

        /**
         * Verify access by roles
         * Verify if user are a candidate/recuiter else display form
         * Nav need diferent paremter for user account recuiter/Applicant
         */

        if($this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('admin');
        }

        if(!$this->isGranted('ROLE_RECUITER')){

            if(!$applicant){
                return $this->redirectToRoute('app_applicants_form');
            }
                if($applicant->isVerify()){

                    return $this->render('jobs/jobs_list.html.twig',[
                        'jobs' => $repo->findAll(),
                        'applicant' => $applicant
                    ]);} else {
                        return $this->render('modals/wait_valid_applicant.html.twig',[
                            'applicant'=> $applicant
                        ]);
                    }
            

        } elseif($this->isGranted('ROLE_RECUITER')){
                
            if(!$recuiter) {
                return $this->redirectToRoute('app_recuiter_form');
            }

            return $this->render('jobs/jobs_list.html.twig',[
                'jobs' => $repo->findAll(),
                'recuiter' => $recuiter
            ]);
        } else {
            return throw $this->createNotFoundException('Une erreur est survenue');
        }

    }



    #[Route('candidat/{id}/job/{jobId}', name: 'app_jobs_view')]  
      
    /**
     * jobView
     *
     * @param  mixed $id
     * @param  mixed $jobId
     * @param  mixed $doctrine
     * @return object 
     */
    public function jobView($id, $jobId, ManagerRegistry $doctrine): Response
    {
        
        $repository = $doctrine->getManager()->getRepository(JobsOffers::class);
        $job = $repository->find($jobId);
        
        if(!$job) {
            throw $this->createNotFoundException(
                'Il n\'y a pas d\'offre avec cet identifiant'
            );
        }

        $repositoryApplicant = $doctrine->getManager()->getRepository(Applicants::class);
        $applicant= $repositoryApplicant->find($id);

        return $this->render('jobs/job_view.html.twig',[
            'job' => $job
        ]);

    }

    
    
    #[Route('candidat/{id}/job/{jobId}/postuler', name: 'app_job_apply')]    
    /**
     * applyJob
     *
     * @param  mixed $id
     * @param  mixed $jobId
     * @return object
     */
    public function applyJob($id, 
    $jobId,
    ManagerRegistry $doctrine,
    JobsOffersRepository $job,
    ApplicantsRepository $applicant,
    Request $request, 
    EntityManagerInterface 
    $entityManagerInterface,
    MailerInterface $mailer
    ): Response
    {
        
        $apply = new Apply();

        $repository = $doctrine->getRepository(JobsOffers::class);
        $jobId = $repository->findOneBy(['id' => $jobId]);

        //GET USER EMAIL FOR SEND MAIL AN CV
        $authorId = $jobId->getAuthorId();
        $repositoryRecuiter = $doctrine->getRepository(Recuiters::class);
        $companyId =  $repositoryRecuiter->findOneBy(['id'=>$authorId]);
        $findUserId = $companyId->getCreatedBy();
        $repositoryUser = $doctrine->getRepository(Users::class);
        $postedBy = $repositoryUser->findOneBy(['id'=>$findUserId]);


        $form = $this->createForm(ApplyType::class, $apply);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $apply->setApplicantsId($applicant->find($id));
                $apply->setJobsOffersId($jobId);     
                $apply=$form->getData();

                
                // Send Mail, such as saving to the database
                $email = (new Email())
                ->from('crtConseil@example.com')
                ->to($postedBy->getEmail())
                ->subject('Nouvelle candidature')
                ->text('Vous Trouverez-ci joint le CV de '
                .$applicant->find($id)->getFirstName().' '
                .$applicant->find($id)->getLastName())
                ->attachFromPath('uploads/cv/'.$applicant->find($id)->getCv());
        
                $mailer->send($email);



                //need verify before Post (THINK TODO)
                $this->addFlash(
                    'warning',
                    'Vous avez déjà postulé à cette offre'
                 );

                $entityManagerInterface->persist($apply);
                $entityManagerInterface->flush();
                    
                // Put some message if apply is right (THINK TODO)
                $this->addFlash(
                   'success',
                   'Votre candidature à été prise en compte et est en attente de validation'
                );

                return $this->redirectToRoute('app_jobs',[
                    'applicant' => $applicant
                ]);

            } else {

                $this->addFlash(
                    'warning',
                    'Vous avez déjà postulé à cette offre'
                 );


            }


        return $this->renderForm('jobs/job_apply.html.twig',[
            'form' => $form,
            'jobId' => $job->find($jobId),
            'applicant' => $applicant->find($id)
        ]);
    }

    #[Route('recuiter/{id}/job/{jobId}', name: 'app_recuiter_jobs_view')]  
      
    /**
     * jobView
     *
     * @param  mixed $id
     * @param  mixed $jobId
     * @param  mixed $doctrine
     * @return Response
     */
    public function RecuiterjobView($id, $jobId, ManagerRegistry $doctrine): Response
    {
        
        $repository = $doctrine->getManager()->getRepository(JobsOffers::class);
        $job = $repository->find($jobId);
        
        if(!$job) {
            throw $this->createNotFoundException(
                'Il n\'y a pas d\'offre avec cet identifiant'
            );
        }

        // $repositoryApply = $doctrine->getManager()->getRepository(Appy::class);
        // $applier= $repositoryApply->find($id);

        return $this->render('Recuiters/aplies.html.twig',[
            'job' => $job
        ]);
    }



}
