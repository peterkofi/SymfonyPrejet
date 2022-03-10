<?php

namespace App\Controller;

use App\Entity\SousAction;
use App\Form\SousActionType;
use App\Form\SousActiviteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('sous_action')]
class SousActionController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'sous_action.edit')]
    public function addProgramme(SousAction $sousAction=null, ManagerRegistry $doctrine,Request $request): Response
    {
        $new=false;
       
            if(!$sousAction){ 
                $new=true;
                $sousAction= new SousAction();
            }
     //   
     if($new){
        $sousAction->setCreatedBy($this->getUser());
        $message='cette sous action a été ajoutée avec succès !';
     
     }else{
         $message='cette sous action a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(SousActionType::class, $sousAction);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($programme)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($sousAction);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('sous_action.list');
            }else{


                 return $this->render('sous_action/create_sous_action.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }
    #[Route('/{page?1}/{nbre?10}', name: 'sous_action.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository=$doctrine->getRepository(SousAction::class);
     
        $nombreAction=$repository->count([]);

     //   $nbre=10;
       
        $nombrePage=ceil($nombreAction/$nbre);

     //  $programme=$repository->findAll();

      $sousAction=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
       return $this->render('sous_action/index.html.twig', [
           'sousAction' => $sousAction,
           'isPaginated'=>true,
            'nbrePage'=>$nombrePage,
            'page'=>$page,
            'nbre'=>$nbre

       ]);
    }
    #[Route('/{id<\d+>}', name: 'sous_action.detail')]
    public function detailProgramme(SousAction $sousAction, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $sousAction=$entityManager->find($id);
       
         if(!$sousAction){
             $this->addFlash('error'," cette sous action recherche n'existe pas");
            return $this->redirectToRoute('sous_action.list');
        }
        
        return $this->render('sous_action/detail.html.twig', [
             'sousAction'=>$sousAction
        ]);
    }

    #[Route('/delete/{id}', name: 'sous_action.delete')]
    public function deleteProgramme( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(SousAction::class);
 
          $sousAction=$entityManager->find($id);

      //  dd($programme);
        
         if($sousAction){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($sousAction);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('sous_action.list');
    }
}
