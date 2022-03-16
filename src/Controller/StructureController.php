<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('structure')]

class StructureController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'structure.edit')]
    public function addStructure(Structure $structure=null, ManagerRegistry $doctrine,Request $request): Response
    {
     
        $new=false;
       
            if(!$structure){ 
                $new=true;
                $structure= new Structure();
            }
     //   
     if($new){
        $structure->setCreatedBy($this->getUser());
        $message='cette structure a été ajouté avec succès !';
     
     }else{
         $message='cette structure a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(StructureType::class, $structure);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($structure)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($structure);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('structure.list');
            }else{


                 return $this->render('structure/create_structure.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');  
    }
    #[Route('/{page?1}/{nbre?10}', name: 'structure.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {

         $repository=$doctrine->getRepository(Structure::class);
     
         $nombreStructure=$repository->count([]);

      //   $nbre=10;
        
         $nombrePage=ceil($nombreStructure/$nbre);

      //  $structure=$repository->findAll();

       $structure=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
        return $this->render('structure/index.html.twig', [
            'structure' => $structure,
            'isPaginated'=>true,
             'nbrePage'=>$nombrePage,
             'page'=>$page,
             'nbre'=>$nbre

        ]);
    }
    #[Route('/{id<\d+>}', name: 'structure.detail')]
    public function detailStructure(Structure $structure, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Structure::class);
 
        //  $structure=$entityManager->find($id);
       
         if(!$structure){
             $this->addFlash('error'," ce structure recherche n'existe pas");
            return $this->redirectToRoute('structure.list');
        }
        
        return $this->render('structure/detail.html.twig', [
             'structure'=>$structure
        ]);
    }
    #[Route('/delete/{id}', name: 'structure.delete')]
    public function deleteStructure( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(Structure::class);
 
          $structure=$entityManager->find($id);

      //  dd($structure);
        
         if($structure){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($structure);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('structure.list');
    }
}
