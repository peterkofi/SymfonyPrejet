<?php

namespace App\Controller;

use App\Entity\ZoneDeSante;
use App\Form\ZoneDeSanteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('zoneDeSante')]
class ZoneDeSanteController extends AbstractController
{
    #[Route('/edit/{id?0}', name: 'zoneDeSante.edit')]
    public function addZoneDeSante(ZoneDeSante $zoneDeSante=null, ManagerRegistry $doctrine, Request $request): Response
    {
     
        $new=false;
       
            if(!$zoneDeSante){ 
                $new=true;
                $zoneDeSante= new ZoneDeSante();
            }
     //   
     if($new){
        $zoneDeSante->setCreatedBy($this->getUser());
        $message='le zone de santé a été ajouté avec succès !';
     
     }else{
         $message='le zone de santé a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(ZoneDeSanteType::class, $zoneDeSante);
            $form->remove("createdAt");
            $form->remove("updatedAt");
            $form->remove("createdBy");
            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  $progrmme=$form->getData(); dd($progrmme); ==> dd($zoneDeSante)


                $entityManager=$doctrine->getManager();

                $entityManager->persist($zoneDeSante);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('zoneDeSante.list');
            }else{


                 return $this->render('zone_de_sante/create_zoneDeSante.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');  
    }
    #[Route('/{page?1}/{nbre?10}', name: 'zoneDeSante.list')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {

         $repository=$doctrine->getRepository(ZoneDeSante::class);
     
         $nombreZoneDeSante=$repository->count([]);

      //   $nbre=10;
        
         $nombrePage=ceil($nombreZoneDeSante/$nbre);

      //  $zoneDeSante=$repository->findAll();

       $zoneDeSante=$repository->findBy([],[], $nbre, ($page - 1)*$nbre);
        return $this->render('zone_de_sante/index.html.twig', [
            'zoneDeSante' => $zoneDeSante,
            'isPaginated'=>true,
             'nbrePage'=>$nombrePage,
             'page'=>$page,
             'nbre'=>$nbre

        ]);
    }
    #[Route('/{id<\d+>}', name: 'zoneDeSante.detail')]
    public function detailZoneDeSante(ZoneDeSante $zoneDeSante, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(ZoneDeSante::class);
 
        //  $zoneDeSante=$entityManager->find($id);
       
         if(!$zoneDeSante){
             $this->addFlash('error'," cette zone de santé recherche n'existe pas");
            return $this->redirectToRoute('zoneDeSante.list');
        }
        
        return $this->render('zone_de_sante/detail.html.twig', [
             'zoneDeSante'=>$zoneDeSante
        ]);
    }
    #[Route('/delete/{id}', name: 'zoneDeSante.delete')]
    public function deleteZoneDeSante( ManagerRegistry $doctrine,$id): Response
    {
       
          $entityManager=$doctrine->getRepository(ZoneDeSante::class);
 
          $zoneDeSante=$entityManager->find($id);

      //  dd($zoneDeSante);
        
         if($zoneDeSante){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($zoneDeSante);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('zoneDeSante.list');
    }
    
}
