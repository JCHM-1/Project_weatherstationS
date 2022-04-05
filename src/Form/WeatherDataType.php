<?php

namespace App\Form;

use App\Entity\Weatherdata;
use DateTimeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeatherDataType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stn')
            ->add('date' )
            ->add('time' )
            ->add('temp')
            ->add('dewp')
            ->add('stp')
            ->add('slp')
            ->add('visib')
            ->add('wdsp')
            ->add('prcp')
            ->add('sndp')
            ->add('frshtt')
            ->add('cldc')
            ->add('wnddir')
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weatherdata::class,
            'crsf_protection'=> false,
        ]);
    }


    public function mapDataToForms($viewData, \Traversable $forms): void
    {
        // there is no data yet, so nothing to prepopulate
        if (null === $viewData) {
            return;
        }

        // invalid data type
        if (!$viewData instanceof Weatherdata) {
            throw new UnexpectedTypeException($viewData, Color::class);
        }

        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        // initialize form field values
        $forms['stn']->setData($viewData->getStn());
        $forms['date']->setData($viewData->getDate());
        $forms['time']->setData($viewData->getTime());
        $forms['temp']->setData($viewData->getTemp());
        $forms['dewp']->setData($viewData->getDewp());
        $forms['stp']->setData($viewData->getStp());
        $forms['slp']->setData($viewData->getSlp());
        $forms['visib']->setData($viewData->getVisib());
        $forms['wdsp']->setData($viewData->getWdsp());
        $forms['prcp']->setData($viewData->getPrcp());
        $forms['sndp']->setData($viewData->getSndp());
        $forms['frshtt']->setData($viewData->getFrshtt());
        $forms['wnddir']->setData($viewData->getWnddir());

    }

    public function mapFormsToData(\Traversable $forms, &$viewData): void
    {
        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        // as data is passed by reference, overriding it will change it in
        // the form object as well
        // beware of type inconsistency, see caution below
        $viewData = new Weatherdata();
        $forms['stn']->$viewData->getStn();
        $forms['date']->$viewData->getData();
//        $forms['time']->setData($viewData->getTime());
//        $forms['temp']->setData($viewData->getTemp());
//        $forms['dewp']->setData($viewData->getDewp());
//        $forms['stp']->setData($viewData->getStp());
//        $forms['slp']->setData($viewData->getSlp());
//        $forms['visib']->setData($viewData->getVisib());
//        $forms['wdsp']->setData($viewData->getWdsp());
//        $forms['prcp']->setData($viewData->getPrcp());
//        $forms['sndp']->setData($viewData->getSndp());
//        $forms['frshtt']->setData($viewData->getFrshtt());
//        $forms['wnddir']->setData($viewData->getWnddir());
    }
}
