<?php

namespace App\Form;

use App\Entity\Timesheet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class TimesheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('workDay', DateType::class, [
                 'widget' => 'single_text',
                 'html5' => false,
                 'attr' => ['class' => 'js-datepicker'],
                 'empty_data' => (new \DateTime('today'))->format('Y-m-d')
            ])
            ->add('comment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timesheet::class,
        ]);
    }
}
