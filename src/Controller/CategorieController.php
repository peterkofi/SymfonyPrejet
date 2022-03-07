<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie')]

class CategorieController extends AbstractController
{
    #[Route('/', name: 'categorie.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(categorie::class);

        $categorie=$repository->findAll();
        return $this->render('categorie/index.html.twig',[
            'categorie'=>$categorie
        ]);
    }
    #[Route('/{id<\d+>}', name: 'categorie.detail')]
    public function detailProgramme(Categorie $categorie, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$categorie){
             $this->addFlash('error'," ce categorie recherche n'existe pas");
            return $this->redirectToRoute('categorie.list');
        }
        
        return $this->render('Categorie/detail.html.twig', [
             'categorie'=>$categorie
        ]);
    }


    #[Route('/edit/{id?0}', name: 'categorie.edit')]
    public function addProgramme(Categorie $categorie=null, ManagerRegistry $doctrine,Request $request): Response
    {
          
        $new=false;
       
            if(!$categorie){ 
                $new=true;
                $categorie= new Categorie();
            }
     //   
     if($new){
        $categorie->setCreatedBy($this->getUser());
        $message='le categorie a été ajouté avec succès !';
     
     }else{
         $message='le categorie a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(CategorieType::class, $categorie);
            $form->remove("createdAt");
            $form->remove("updatedAt");
            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  dd($form->getData()); == dd($programme)

                $entityManager=$doctrine->getManager();

                $entityManager->persist($categorie);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('categorie.list');
            }else{


                 return $this->render('Categorie/create_Categorie.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }

    // #[Route('/add/{libelle}/{description}', name: 'categorie.addParam')]
    // public function addParamCategorie(ManagerRegistry $doctrine, $libelle, $description): Response
    // {
    //     $entityManager=$doctrine->getManager();

    //     $categorie=new Categorie();
    //     $categorie->setLibelle($libelle);
    //     $categorie->setDescription($description);

    //     $entityManager->persist($categorie);


    //     $entityManager->flush();

    //     return $this->render('categorie/index.html.twig');
    // }
    #[Route('/delete/{id}', name: 'categorie.delete')]
    public function deleteProgramme(Categorie $categorie, ManagerRegistry $doctrine,$id): Response
    {
       
        //   $entityManager=$doctrine->getRepository(Programme::class);
 
        //   $programme=$entityManager->find($id);

      //  dd($programme);
        
         if($categorie){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($categorie);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('categorie.list');
    }
}
