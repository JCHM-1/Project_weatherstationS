<?php

namespace App\Form;

use App\Entity\Data;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherdataFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stn')
            ->add('Search', SubmitType::class)
//            ->add('date')
//            ->add('time')
//            ->add('temp')
//            ->add('dewp')
//            ->add('stp')
//            ->add('slp')
//            ->add('visib')
//            ->add('wdsp')
//            ->add('prcp')
//            ->add('sndp')
//            ->add('frshtt')
//            ->add('cldc')
//            ->add('wnddir')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Data::class,
        ]);
    }
}
