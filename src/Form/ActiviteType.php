<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\SousAction;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('sousAction',EntityType::class,[
                'expanded'=>false,
                 'multiple'=>true,
                 'class'=>SousAction::class,
                 'required'=>false,
                 'query_builder'=>function(EntityRepository $er){
                       return $er->createQueryBuilder('s')
                                 ->orderBy('s.libelle','ASC');

                 },
                       
                 'attr'=>[
                     'class'=>'select2'
                 ]
 
             ])
             ->add('editer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
        ]);
    }
}
