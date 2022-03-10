<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Form\ActiviteType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('activite')]
class ActiviteController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'activite.edit')]
    public function addActivite(Activite $activite=null, ManagerRegistry $doctrine,Request $request): Response
    {
        $new=false;
       
            if(!$activite){ 
                $new=true;
                $activite= new Activite();
            }
     //   
     if($new){
        $activite->setCreatedBy($this->getUser());
        $message='la activite a été ajouté avec succès !';
     
     }else{
         $message='la activite a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(ActiviteType::class, $activite);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($programme)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($activite);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('activite.list');
            }else{


                 return $this->render('activite/create_activite.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }
    #[Route('/{page?1}/{nbre?10}', name: 'activite.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository=$doctrine->getRepository(Activite::class);
     
        $nombreActivite=$repository->count([]);

     //   $nbre=10;
       
        $nombrePage=ceil($nombreActivite/$nbre);

     //  $programme=$repository->findAll();

      $activite=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
       return $this->render('activite/index.html.twig', [
           'activite' => $activite,
           'isPaginated'=>true,
            'nbrePage'=>$nombrePage,
            'page'=>$page,
            'nbre'=>$nbre

       ]);
    }
    #[Route('/{id<\d+>}', name: 'activite.detail')]
    public function detailActivite(Activite $activite=null, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Activite::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$activite){
             $this->addFlash('error'," cette activite n'existe pas");
            return $this->redirectToRoute('activite.list');
        }
        
        return $this->render('activite/detail.html.twig', [
             'activite'=>$activite
        ]);
    }
    #[Route('/delete/{id}', name: 'Activite.delete')]
    public function deleteActivite( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(Activite::class);
 
          $activite=$entityManager->find($id);

      //  dd($Activite);
        
         if($activite){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($activite);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('activite.list');
    }
}
