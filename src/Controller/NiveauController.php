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


                 return $this->render('niveau/create_niveau.html.twig',[
            'form' => $form->createView()
        ]);
            }

    //    $this->addFlash(type:'success',message:'ajout reussi !');     
    }

    #[Route('/{page?1}/{nbre?10}', name: 'niveau.list')]
    public function index(ManagerRegistry $doctrine,$page,$nbre): Response
    {
        $repository=$doctrine->getRepository(Niveau::class);

        $nombreNiveau=$repository->count([]);
   
        $nombrePage=ceil($nombreNiveau/$nbre);

        $niveau=$repository->findBy([],[], $nbre, ($page-1)*$nbre);
        
        return $this->render('niveau/index.html.twig',[
            'niveau'=>$niveau,
            'isPaginated'=>true,
            'page'=>$page,
            'nbrePage'=>$nombrePage,
            'nbre'=>$nbre
        ]);
    }

    #[Route('/{id<\d+>}', name: 'niveau.detail')]
    public function detailNiveau(Niveau $niveau, ManagerRegistry $doctrine,$id): Response
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
