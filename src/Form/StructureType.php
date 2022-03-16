<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Structure;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('typeDeStructure',ChoiceType::class,[
                'choices'=>[
                    'Aucun'=>'Aucun',
                    'Parent'=>'Parent',
                    'Enfant'=>'Enfant'
                ]
            ])
            ->add('description')
            ->add('StructureDeReference',EntityType::class,[
                'expanded'=>false,
                 'multiple'=>false,
                 'class'=>Structure::class,
                 'required'=>false,
                 'query_builder'=>function(EntityRepository $er){
                       return $er->createQueryBuilder('s')
                                 ->orderBy('s.libelle','ASC');

                 },
                       
                 'attr'=>[
                     'class'=>'select2'
                 ]
 
             ])
            ->add('categorie',EntityType::class,[
                'expanded'=>false,
                 'multiple'=>false,
                 'class'=>Categorie::class,
                 'required'=>false,
                 'query_builder'=>function(EntityRepository $er){
                       return $er->createQueryBuilder('c')
                                 ->orderBy('c.libelle','ASC');

                 },
                       
                 'attr'=>[
                     'class'=>'select2'
                 ]
 
             ])
             ->add('editer',type: SubmitType::class);
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
