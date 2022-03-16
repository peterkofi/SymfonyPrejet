<?php

namespace App\Controller;

use APP\Entity\TypeValidationUF;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('typeValidationUF')]
class TypeValidationUFController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'typeValidationUF.edit')]
    public function addTypeValidationUF(TypeValidationUF $typeValidationUF=null, ManagerRegistry $doctrine,Request $request): Response
    {
     
        $new=false;
       
            if(!$typeValidationUF){ 
                $new=true;
                $typeValidationUF= new TypeValidationUF();
            }
     //   
     if($new){
        $typeValidationUF->setCreatedBy($this->getUser());
        $message='le type de validation a été ajouté avec succès !';
     
     }else{
         $message='le type de validation a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(TypeValidationUFType::class, $typeValidationUF);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($typeValidationUF)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($typeValidationUF);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('typeValidationUF.list');
            }else{


                 return $this->render('type_validation_uf/create_typeValidationUF.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');  
    }
    #[Route('/{page?1}/{nbre?10}', name: 'typeValidationUF.list')]
    public function index(ManagerRegistry $doctrine,$page,$nbre): Response
    {
       
        $repository=$doctrine->getRepository(TypeValidationUF::class);
     
        $nombretypeValidationUF=$repository->count([]);

        $nbre=10;
       
        $nombrePage=ceil($nombretypeValidationUF/$nbre);

        $typeValidationUF=$repository->findBy([],[], $nbre, ($page-1)*$nbre);

        return $this->render('typeValidationUF/index.html.twig', [
            'typeValidationUF' => $typeValidationUF,
            'isPaginated'=>true,
            'page'=>$page,
            'nbrePage'=>$nombrePage,
            'nbre'=>$nbre
        ]);
    }
    #[Route('/{id<\d+>}', name: 'typeValidationUF.detail')]
    public function detailTypeValidationUF(ManagerRegistry $doctrine,$id): Response
    {
         $entityManager=$doctrine->getRepository(TypeValidationUF::class);
 
         $typeValidationUF=$entityManager->find($id);
       
         if(!$typeValidationUF){
             $this->addFlash('error',"le type de validation rechercheé n'existe pas");
            return $this->redirectToRoute('typeValidationUF.list');
        }
        
        return $this->render('type_validation_uf/detail.html.twig', [
             'typeValidationUF'=>$typeValidationUF
        ]);
    }
    #[Route('/delete/{id}', name: 'typeValidationUF.delete')]
    public function deleteTypeValidationUF( ManagerRegistry $doctrine,$id): RedirectResponse
    {
       
          $entityManager=$doctrine->getRepository(TypeValidationUF::class);
 
          $typeValidationUF=$entityManager->find($id);

      //  dd($programme);
        
         if($typeValidationUF){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($typeValidationUF);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('typeValidationUF.list');
    }
    
    
}
