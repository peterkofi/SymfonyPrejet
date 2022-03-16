<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\SousActivite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SousActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('activite',EntityType::class,[
                'expanded'=>false,
                 'multiple'=>false,
                 'class'=>Activite::class,
                 'required'=>false,
                 'query_builder'=>function(EntityRepository $er){
                       return $er->createQueryBuilder('a')
                                 ->orderBy('a.libelle','ASC');

                 },
                       
                 'attr'=>[
                     'class'=>'select2'
                 ]
 
             ])
            ->add('montant')
            ->add('devise',ChoiceType::class,[
                'choices'=>[
                    'CDF'=>'CDF',
                    'USD'=>'USD'
                ]
            ])
            ->add('editer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousActivite::class,
        ]);
    }
}
