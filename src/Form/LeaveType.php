<?php

namespace App\Form;

use App\Entity\Leave;
use App\Entity\LeaveType as LeaveFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeaveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leaveType', EntityType::class, [
                'class' => LeaveFormType::class,
                'choice_label' => 'name',
            ])
 
            ->add('fromDate')
            ->add('toDate')
            ->add('type', ChoiceType::class, [
                'choices'  => array_flip(Leave::LEAVE_DAY_OPTIONS)
            ])
            ->add('reason', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Leave::class,
        ]);
    }
}
