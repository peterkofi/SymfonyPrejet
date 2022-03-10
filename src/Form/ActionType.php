<?php

namespace App\Form;

use App\Entity\Planification;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('planification',EntityType::class,[
                'expanded'=>false,
                 'multiple'=>true,
                 'class'=>Planification::class,
                 'required'=>false,
                 'query_builder'=>function(EntityRepository $er){
                       return $er->createQueryBuilder('p')
                                 ->orderBy('p.programme','ASC');

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
            'data_class' => Action::class,
        ]);
    }
}
