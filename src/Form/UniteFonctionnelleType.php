<?php

namespace App\Form;

use App\Entity\UniteFonctionnelle;
use App\Entity\Programme;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UniteFonctionnelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('programme',EntityType::class,[
                'expanded'=>false,
                'required'=>false,
                'multiple'=>false,
                'class'=>Programme::class,
                'attr'=>[
                    'class'=>'select2'
                ]
            ])
            ->add('Categorie',EntityType::class,[
                'expanded'=>false,
                'required'=>false, 
                'class'=>Categorie::class,
                'multiple'=>false,
               
                'attr'=>[
                    'class'=>'select2'
                ]
            ])
            ->add('editer',type: SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UniteFonctionnelle::class,
        ]);
    }
}
