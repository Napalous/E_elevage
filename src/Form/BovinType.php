<?php

namespace App\Form;

use App\Entity\Bovin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BovinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_ordre')
            ->add('sexe', ChoiceType::class, [
            'choices' => [                    
                'Mâle' => 'M',
                'Femelle' => 'F',                
            ]
            ])
            ->add('date_naissance')
            ->add('categories')
            ->add('races')
            ->add('types')
            ->add('bovin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bovin::class,
        ]);
    }
}
