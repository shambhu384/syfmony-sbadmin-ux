<?php

namespace App\Form;

use App\Entity\Onboarding;
use App\Entity\Stock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OnboardingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class, [
                // looks for choices from this entity
                'class' => Stock::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'name',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('response', ChoiceType::class, [
                'choices'  => array_flip(Onboarding::OPTIONS)
            ])
            ->add('comment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Onboarding::class,
        ]);
    }
}
