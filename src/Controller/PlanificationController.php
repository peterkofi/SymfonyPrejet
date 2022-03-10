<?php

namespace App\Controller;

use App\Entity\Planification;
use App\Form\PlanificationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('planification')]
class PlanificationController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'planification.edit')]
    public function addProgramme(Planification $planification=null, ManagerRegistry $doctrine,Request $request): Response
    {
        $new=false;
       
            if(!$planification){ 
                $new=true;
                $planification= new Planification();
            }
     //   
     if($new){
        $planification->setCreatedBy($this->getUser());
        $message='la planification a été ajouté avec succès !';
     
     }else{
         $message='la planification a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(PlanificationType::class, $planification);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($programme)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($planification);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('planification.list');
            }else{


                 return $this->render('planification/create_planification.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }
    #[Route('/{page?1}/{nbre?10}', name: 'planification.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository=$doctrine->getRepository(Planification::class);
     
         $nombrePlanification=$repository->count([]);

      //   $nbre=10;
        
         $nombrePage=ceil($nombrePlanification/$nbre);

      //  $programme=$repository->findAll();

       $planification=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
        return $this->render('planification/index.html.twig', [
            'planification' => $planification,
            'isPaginated'=>true,
             'nbrePage'=>$nombrePage,
             'page'=>$page,
             'nbre'=>$nbre

        ]);
    }
    #[Route('/{id<\d+>}', name: 'planification.detail')]
    public function detailProgramme(Planification $planification=null, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$planification){
             $this->addFlash('error'," cette planification n'existe pas");
            return $this->redirectToRoute('planification.list');
        }
        
        return $this->render('planification/detail.html.twig', [
             'planification'=>$planification
        ]);
    }
   
    #[Route('/delete/{id}', name: 'planification.delete')]
    public function deleteProgramme( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(Planification::class);
 
          $planification=$entityManager->find($id);

      //  dd($planification);
        
         if($planification){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($planification);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('planification.list');
    }
}
