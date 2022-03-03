<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use Doctrine\Persistence\ManagerRegistry;
use Illuminate\Http\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/niveau')]
class NiveauController extends AbstractController
{
    #[Route('/', name: 'niveau.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Niveau::class);

        $niveau=$repository->findAll();
        return $this->render('niveau/index.html.twig',[
            'niveau'=>$niveau
        ]);
    }

    #[Route('/{id<\d+>}', name: 'niveau.detail')]
    public function detailProgramme(Niveau $niveau, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$niveau){
             $this->addFlash('error'," ce niveau recherche n'existe pas");
            return $this->redirectToRoute('niveau.list');
        }
        
        return $this->render('Niveau/detail.html.twig', [
             'niveau'=>$niveau
        ]);
    }

    #[Route('/edit/{id?0}', name: 'niveau.edit')]
    public function addNiveau(Niveau $niveau=null, ManagerRegistry $doctrine,Request $request): Response
    {
          
        $new=false;
       
            if(!$niveau){ 
                $new=true;
                $niveau= new Niveau();
            }
     //   
     if($new){
        $message='le niveau a été ajouté avec succès !';
     
     }else{
         $message='le niveau a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(NiveauType::class, $niveau);
            $form->remove("createdAt");
            $form->remove("updatedAt");
            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  dd($form->getData()); == dd($programme)

                $entityManager=$doctrine->getManager();

                $entityManager->persist($niveau);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('niveau.list');
            }else{


                 return $this->render('Niveau/create_programme.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');
   
       
    }

    #[Route('/edit/{id?0}', name:'niveau.edit')]
    public function addProgramme(Niveau $niveau=null, ManagerRegistry $doctrine,Request $request): Response
    {
          
        $new=false;
       
            if(!$niveau){ 
                $new=true;
                $niveau= new Niveau();
            }
     //   
     if($new){
        $message='le programme a été ajouté avec succès !';
     
     }else{
         $message='le programme a été mise à jour avec succès !';
     }
       
         $form=$this->createForm(NiveauType::class, $niveau);
            $form->remove("createdAt");
            $form->remove("updatedAt");
            $form->handleRequest($request);
            if($form->isSubmitted() ){    
               
             //  dd($form->getData()); == dd($programme)

                $entityManager=$doctrine->getManager();

                $entityManager->persist($niveau);

                $entityManager->flush();

                $this->addFlash(type:'success',message: $message);
            
                return $this->redirectToRoute('niveau.list');
            }else{


                 return $this->render('Niveau/create_programme.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');     
    }
    
    #[Route('/delete/{id}', name: 'niveau.delete')]
    public function deleteProgramme(Niveau $niveau, ManagerRegistry $doctrine,$id): Response
    {    
        //   $entityManager=$doctrine->getRepository(Programme::class);
 
        //   $programme=$entityManager->find($id);
        
         if($niveau){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($niveau);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('niveau.list');
    }
    // #[Route('/add/{libelle}/{description}', name: 'niveau.addParam')]
    // public function addParamCategorie(ManagerRegistry $doctrine, $libelle, $description): RedirectResponse
    // {
    //     $entityManager=$doctrine->getManager();

    //     $niveau=new Niveau();
    //     $niveau->setLibelle($libelle);
    //     $niveau->setDescription($description);

    //     $entityManager->persist($niveau);


    //     $entityManager->flush();

    //     return $this->redirectToRoute('niveau.list');
    // }
}
