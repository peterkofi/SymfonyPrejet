<?php

namespace App\Controller;

use App\Entity\Action;
use App\Form\ActionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('action')]
class ActionController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'action.edit')]
    public function addProgramme(Action $action=null, ManagerRegistry $doctrine,Request $request): Response
    {
     
        $new=false;
       
            if(!$action){ 
                $new=true;
                $action= new Action();
            }
     //   
     if($new){
        $action->setCreatedBy($this->getUser());
        $message='cette action a été ajouté avec succès !';
     
     }else{
         $message='cette Action a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(ActionType::class, $action);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($programme)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($Action);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('programme.list');
            }else{


                 return $this->render('Action/create_programme.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }
    #[Route('/{page?1}/{nbre?10}', name: 'action.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        
        $repository=$doctrine->getRepository(Action::class);
     
        $nombreAction=$repository->count([]);

     //   $nbre=10;
       
        $nombrePage=ceil($nombreAction/$nbre);

     //  $programme=$repository->findAll();

      $action=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
       return $this->render('action/index.html.twig', [
           'action' => $action,
           'isPaginated'=>true,
            'nbrePage'=>$nombrePage,
            'page'=>$page,
            'nbre'=>$nbre

       ]);
    }

   
    #[Route('/delete/{id}', name: 'action.delete')]
    public function deleteProgramme( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(Action::class);
 
          $action=$entityManager->find($id);

      //  dd($action);
        
         if($action){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($action);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('action.list');
    }
}
