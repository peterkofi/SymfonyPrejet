<?php

namespace App\Controller;

use App\Entity\UniteFonctionnelle;
use App\Entity\Categorie;
use App\Entity\Programme;
use App\Form\UniteFonctionnelleType;
use Doctrine\Persistence\ManagerRegistry;
use Illuminate\Http\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\at;

#[Route('/unitefonctionnelle')]
class UnitefonctionnelleController extends AbstractController
{
    #[Route('/', name: 'unitefonctionnelle.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
       
        $repository=$doctrine->getRepository(UniteFonctionnelle::class);
     
        $nombreunitefonctionnelle=$repository->count([]);

        $nbre=10;
       
        $nombrePage=ceil($nombreunitefonctionnelle/$nbre);

       $unitefonctionnelle=$repository->findAll();

        return $this->render('unitefonctionnelle/index.html.twig', [
            'unitefonctionnelle' => $unitefonctionnelle,

            'isPaginated'=>true,
             'nombrePage'=>$nombrePage,
            // 'page'=>$page,
             'nombreElent'=>$nbre

        ],);
    }

    #[Route('/{id<\d+>}', name: 'unitefonctionnelle.detail')]
    public function detailUniteFonctionnelle(ManagerRegistry $doctrine,$id): Response
    {
         $entityManager=$doctrine->getRepository(UniteFonctionnelle::class);
 
         $uniteFonctionnelle=$entityManager->find($id);
       
         if(!$uniteFonctionnelle){
             $this->addFlash('error',"l'unité fonctionnelle rechercheé n'existe pas");
            return $this->redirectToRoute('unitefonctionnelle.list');
        }
        
        return $this->render('unitefonctionnelle/detail.html.twig', [
             'uniteFonctionnelle'=>$uniteFonctionnelle
        ]);
    }

    #[Route('/edit/{id?0}', name: 'unitefonctionnelle.add')]
    public function addUniteFonctionnelle(UniteFonctionnelle $uniteFonctionnelle, ManagerRegistry $doctrine, Request $request): Response
    {
       
        $new=false;
       
        if(!$uniteFonctionnelle){ 
            $new=true; 
            $uniteFonctionnelle= new UniteFonctionnelle();
    
        }
        if($new){
            $uniteFonctionnelle->setCreatedBy($this->getUser());
            $message="l'unité a été ajouté avec succès !";
         
         }else{
             $message="l'unité a été mise à jour avec succès !";
         }
       
        $form=$this->createForm(UniteFonctionnelleType::class,$uniteFonctionnelle);
        $form->remove('createdAt');
        $form->remove('updatedAt');
     //   $this->addFlash(type:'success',message:'ajout reussi !');
   
        $form->handleRequest($request);

        if($form->isSubmitted()){
         //   dd($uniteFonctionnelle);
         //   dd($form->getData());

         $manager=$doctrine->getManager();
         $manager->persist($uniteFonctionnelle);

         $manager->flush();
        
         $this->addFlash(type:'success',message:$message);
      
          return  $this->redirectToRoute('unitefonctionnelle.list');
        }else{
             return $this->render('unitefonctionnelle/create_unitefonctionnelle.html.twig',[
            'form' => $form->createView()
            ]);
        }
        
    }

    // #[Route('/add/{libelle}/{description}', name: 'unitefonctionnelle.addParam')]
    // public function addUniteFonctionnelleParam(ManagerRegistry $doctrine,$libelle,$description): RedirectResponse
    // {
    //     $entityManager=$doctrine->getManager();
 
    //      $uniteFonctionnelle= new UniteFonctionnelle();

    //     $uniteFonctionnelle->setLibelle($libelle);
    //     $uniteFonctionnelle->setDescription($description);
    
    //     $entityManager->persist($uniteFonctionnelle);

    //     $entityManager->flush();
     
    //     $this->addFlash(type:'success',message:'ajout reussi !');
   
    //     return $this->redirectToRoute('unitefonctionnelle.list');
    // }

    #[Route('/delete/{id}', name: 'unitefonctionnelle.delete')]
    public function deleteUniteFonctionnelle( ManagerRegistry $doctrine,$id): RedirectResponse
    {
       
          $entityManager=$doctrine->getRepository(UniteFonctionnelle::class);
 
          $uniteFonctionnelle=$entityManager->find($id);

      //  dd($programme);
        
         if($uniteFonctionnelle){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($uniteFonctionnelle);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('unitefonctionnelle.list');
    }
}
