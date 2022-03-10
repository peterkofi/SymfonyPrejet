<?php

namespace App\Controller;

use App\Entity\SousActivite;
use App\Form\SousActiviteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('sous_activite')]
class SousActiviteController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'sous_activite.edit')]
    public function addProgramme(SousActivite $sousActivite=null, ManagerRegistry $doctrine,Request $request): Response
    {
        $new=false;
       
            if(!$sousActivite){ 
                $new=true;
                $sousActivite= new SousActivite();
            }
     //   
     if($new){
        $sousActivite->setCreatedBy($this->getUser());
        $message='la sous activié a été ajouté avec succès !';
     
     }else{
         $message='la sous activité a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(SousActiviteType::class, $sousActivite);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($programme)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($sousActivite);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('sous_activite.list');
            }else{


                 return $this->render('sous_activite/create_programme.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }
    #[Route('/{page?1}/{nbre?10}', name: 'sous_activite.list')]
    public function index(ManagerRegistry $doctrine,$page,$nbre): Response
    {
        $repository=$doctrine->getRepository(SousActivite::class);
     
        $nombreSousActivite=$repository->count([]);

     //   $nbre=10;
       
        $nombrePage=ceil($nombreSousActivite/$nbre);

     //  $programme=$repository->findAll();

      $sousActivite=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
       return $this->render('sous_activite/index.html.twig', [
           'sousActivite' => $sousActivite,
           'isPaginated'=>true,
            'nbrePage'=>$nombrePage,
            'page'=>$page,
            'nbre'=>$nbre

       ]);
    }
    #[Route('/{id<\d+>}', name: 'sous_activite.detail')]
    public function detailProgramme(SousActivite $sousActivite=null, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$sousActivite){
             $this->addFlash('error'," cette sousActivite n'existe pas");
            return $this->redirectToRoute('sous_activite.list');
        }
        
        return $this->render('sous_activite/detail.html.twig', [
             'sousActivite'=>$sousActivite
        ]);
    }
   
    #[Route('/delete/{id}', name: 'sous_activite.delete')]
    public function deleteProgramme( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(SousActivite::class);
 
          $sousActivite=$entityManager->find($id);

      //  dd($sousActivite);
        
         if($sousActivite){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($sousActivite);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('sous_activite.list');
    }
}
