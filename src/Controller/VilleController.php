<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('ville')]
class VilleController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'ville.edit')]
    public function addVille(Ville $ville=null, ManagerRegistry $doctrine,Request $request): Response
    {
     
        $new=false;
       
            if(!$ville){ 
                $new=true;
                $ville= new Ville();
            }
     //   
     if($new){
        $ville->setCreatedBy($this->getUser());
        $message='cette ville a été ajouté avec succès !';
     
     }else{
         $message='cette ville a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(VilleType::class, $ville);
            $form->remove("createdAt");
            $form->remove("updatedAt");

            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($ville)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($ville);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('ville.list');
            }else{


                 return $this->render('ville/create_ville.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');  
    }
    #[Route('/{page?1}/{nbre?10}', name: 'ville.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {

         $repository=$doctrine->getRepository(Ville::class);
     
         $nombreVille=$repository->count([]);

      //   $nbre=10;
        
         $nombrePage=ceil($nombreVille/$nbre);

      //  $ville=$repository->findAll();

       $ville=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
        return $this->render('ville/index.html.twig', [
            'ville' => $ville,
            'isPaginated'=>true,
             'nbrePage'=>$nombrePage,
             'page'=>$page,
             'nbre'=>$nbre

        ]);
    }
    #[Route('/{id<\d+>}', name: 'ville.detail')]
    public function detailVille(Ville $ville, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Ville::class);
 
        //  $ville=$entityManager->find($id);
       
         if(!$ville){
             $this->addFlash('error'," ce ville recherche n'existe pas");
            return $this->redirectToRoute('ville.list');
        }
        
        return $this->render('ville/detail.html.twig', [
             'ville'=>$ville
        ]);
    }
    #[Route('/delete/{id}', name: 'ville.delete')]
    public function deleteVille( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(Ville::class);
 
          $ville=$entityManager->find($id);

      //  dd($ville);
        
         if($ville){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($ville);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('ville.list');
    }

}
