<?php

namespace App\Form;

use App\Entity\Weatherdata;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stn')
            ->add('date', DateType::class)
            ->add('time', TimeType::class)
            ->add('temp')
            ->add('dewp')
            ->add('stp')
            ->add('slp')
            ->add('visib')
            ->add('wdsp')
            ->add('prcp')
            ->add('sndp')
            ->add('frshtt', NumberType::class) // Want wordt aangeleverd als String
            ->add('cldc')
            ->add('wnddir');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weatherdata::class,
        ]);
    }
}
