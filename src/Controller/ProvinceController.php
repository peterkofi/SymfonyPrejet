<?php

namespace App\Controller;

use App\Entity\Province;
use App\Form\ProvinceType;
use Doctrine\Persistence\ManagerRegistry;
use Illuminate\Http\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/province',)]
class ProvinceController extends AbstractController
{
    #[Route('/', name: 'province.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Province::class);

        $province=$repository->findAll();
        return $this->render('province/index.html.twig',[
            'province'=>$province
        ]); 
    }

    #[Route('/{id<\d+>}', name: 'province.detail')]
    public function detailProvince(Province $province, ManagerRegistry $doctrine,$id): Response
    {
        //  $entityManager=$doctrine->getRepository(Programme::class);
 
        //  $programme=$entityManager->find($id);
       
         if(!$province){
             $this->addFlash('error'," ce province recherche n'existe pas");
            return $this->redirectToRoute('province.list');
        }
        
        return $this->render('province/detail.html.twig', [
             'province'=>$province
        ]);
    }


    #[Route('/edit/{id?0}', name: 'province.edit')]
    public function addProvince(Province $province=null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new=false;
        if(!$province){
            $new=true;
            $province =new Province();
        }
        if($new){
            $message='le province a été ajouté avec succès !';
         
         }else{
             $message='le province a été mise à jour avec succès !';
         }
      
        $form=$this->createForm(ProvinceType::class,$province);

        $form->remove('createdAt');
        $form->remove('updatedAt');

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $entityManager=$doctrine->getManager();

            $entityManager->persist($province);

            $entityManager->flush();

            $this->addFlash(type:'success',message: $message);
            
            return $this->redirectToRoute('province.list');
        }else{
            return $this->render('province/create_programme.html.twig',[
                'form' => $form->createView()
            ]);

        }

    }

    #[Route('/delete/{id}', name: 'province.delete')]
    public function deleteProvince(Province $province, ManagerRegistry $doctrine,$id): Response
    {
       
        //   $entityManager=$doctrine->getRepository(Province::class);
 
        //   $programme=$entityManager->find($id);

      //  dd($programme);
        
         if($province){
        
        $entityManager=$doctrine->getManager();
 
        $entityManager->remove($province);

        $entityManager->flush();

        $this->addFlash(type:'success',message:'suppression reussi !');
      
        }else{
            $this->addFlash(type:'error',message:' Echec suppression !');
        }
        
      return $this->redirectToRoute('province.list');
    }

    // #[Route('/add/{libelle}', name: 'province.addParam')]
    // public function addParamProvince(ManagerRegistry $doctrine, $libelle): Response
    // {
    //     $entityManager=$doctrine->getManager();

    //     $province=new Province();
    //     $province->setLibelle($libelle);

    //     $entityManager->persist($province);


    //     $entityManager->flush();

    //     $this->addFlash(type:'success',message:'ajout reussi !');

    //     return $this->redirectToRoute('province.list');
    // }
}
