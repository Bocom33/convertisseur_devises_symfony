<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('valeur1', NumberType::class)
        ->add('devise1', ChoiceType::class, [
            'choices' => [
                'euro' => 'euro',
                'dollar' => 'dollar'
            ]
        ])
        ->add('valeur2', NumberType::class)
        ->add('devise2', ChoiceType::class, [
            'choices' => [
                'euro' => 'euro',
                'dollar' => 'dollar'
            ]
        ])
        ->add('calcul', SubmitType::class, ['label' => 'Calculer'])
        ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
