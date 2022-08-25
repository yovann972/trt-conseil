<?php

namespace App\Controller;

use App\Entity\JobsOffers;
use App\Entity\Recuiters;
use App\Form\JobEditType;
use App\Form\JobsOffersType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobsFormController extends AbstractController
{

    #[Route('recuiter/{id}/jobs/add', name: 'app_jobs_form')]    
    /**
     * index
     *
     * @param  mixed $id
     * @param  mixed $doctrine
     * @param  mixed $request
     * @param  mixed $entityManagerInterface
     * @return Response
     */
    public function index($id, ManagerRegistry $doctrine ,Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $jobOffer = new JobsOffers();

        $repository = $doctrine->getManager()->getRepository(Recuiters::class);
        $recuiter = $repository->find($id);

        $form = $this->createForm(JobsOffersType::class, $jobOffer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobOffer->setAuthorId($recuiter);
            $jobOffer->setIsActive(false);
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $jobOffer = $form->getData();
            $entityManagerInterface->persist($jobOffer);
            $entityManagerInterface->flush();

            // ... perform some action, such as saving the task to the database  
            $this->addFlash(
                'success',
                'Offre d\'emploi creer avec succès'
        );

            return $this->redirectToRoute('app_recuiter_view',[
                'id' => $id,
                'recuiter' => $recuiter
            ]);
        }
        return $this->renderForm('jobs_form/index.html.twig', [
            'form' => $form,
            'id' => $id
        ]);
    }


    #[Route('recuiter/{id}/edit/job/{jobId}', name:'app_edit_job')]    
    /**
     * editJob
     *
     * @param  mixed $id
     * @param  mixed $jobId
     * @param  mixed $doctrine
     * @param  mixed $request
     * @param  mixed $entityManagerInterface
     * @return Response
     */
    public function editJob($id,int $jobId, ManagerRegistry $doctrine ,Request $request, EntityManagerInterface $entityManagerInterface) : Response
    {
        $repositoryRecuiter = $doctrine->getManager()->getRepository(Recuiters::class);
        $recuiter = $repositoryRecuiter->find($id);

        $repositoryJob = $doctrine->getmanager()->getRepository(JobsOffers::class);
        $jobId = $repositoryJob->find($jobId);
        //$job = $repositoryJob->findOneBy(['authorId'=> $authorId]);


            $form = $this->createForm(JobEditType::class,$jobId);
            
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $jobId->setAuthorId($recuiter);
                $jobId->setIsActive(false);
                $jobId->setUpdatedAt(new \DateTimeImmutable());
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $jobId = $form->getData();
                
                // ... perform some action, such as saving the task to the database
                $entityManagerInterface->persist($jobId);
                $entityManagerInterface->flush();
                $this->addFlash(
                    'success',
                    'Offre d\'emploi modifier avec succès'
                );
                return $this->redirectToRoute('app_recuiter_view',[
                    'id' => $id,
                    'recuiter' => $recuiter
                ]);
            }

            return $this->renderForm('jobs_form/edit_job.html.twig', [
                'form' => $form,
                'id' => $id,
                'jobId' => $jobId
            ]);
    }



    #[Route('recuiter/{id}/delete/job/{jobId}', name:'app_delete_job')]    
    /**
     * deleteJob
     *
     * @param  mixed $id
     * @param  mixed $jobId
     * @param  mixed $doctrine
     * @param  mixed $request
     * @param  mixed $entityManagerInterface
     * @return Response
     */
    public function deleteJob($id,int $jobId, ManagerRegistry $doctrine ,Request $request, EntityManagerInterface $entityManagerInterface) : Response
    {
        $repositoryRecuiter = $doctrine->getManager()->getRepository(Recuiters::class);
        $recuiter = $repositoryRecuiter->find($id);

        $repositoryJob = $doctrine->getmanager()->getRepository(JobsOffers::class);
        $jobId = $repositoryJob->find($jobId);
        
        $entityManagerInterface->remove($jobId);
        $entityManagerInterface->flush();

            return $this->redirectToRoute('app_recuiter_view',[
                'id' => $id,
                'recuiter' => $recuiter
            ]);
    }


}
