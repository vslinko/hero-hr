<?php

namespace Rithis\HeroHRBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\AbstractType;

class VacancyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
            'description' => "Vacancy Title",
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rithis\\HeroHRBundle\\Entity\\Vacancy',
        ));
    }

    public function getName()
    {
        return 'vacancy';
    }
}
