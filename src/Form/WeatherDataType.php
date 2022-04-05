<?php

namespace App\Form;

use App\Entity\Weatherdata;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stn')
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => false
            ])
            ->add('time', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'HH:mm:ss',
                'html5' => false
            ])
            ->add('temp')
            ->add('dewp')
            ->add('stp')
            ->add('slp')
            ->add('visib')
            ->add('wdsp')
            ->add('prcp')
            ->add('sndp')
            ->add('frshtt') // Want wordt aangeleverd als String
            ->add('cldc')
            ->add('wnddir');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weatherdata::class,
            'crsf_protection'=> false,
        ]);
    }
}
