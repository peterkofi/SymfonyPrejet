<?php

namespace App\Form;

use App\Entity\SousAction;
use App\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Dto\ActionDto;

class SousActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('action',EntityType::class,[
                'expanded'=>false,
                 'multiple'=>false,
                 'class'=>Action::class,
                 'required'=>false,
                 'query_builder'=>function(EntityRepository $er){
                       return $er->createQueryBuilder('a')
                                 ->orderBy('a.libelle','ASC');

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
            'data_class' => SousAction::class,
        ]);
    }
}
