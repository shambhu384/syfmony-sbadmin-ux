<?php

namespace App\Form;

use App\Entity\Leave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LeaveApprovalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(Leave::LEAVE_DAY_OPTIONS)
            ])
            ->add('leaveType')
            ->add('reason')
            ->add('fromDate')
            ->add('toDate')
            ->add('status',ChoiceType::class, [
                'choices'  => array_flip(Leave::LEAVE_ACTION)
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
