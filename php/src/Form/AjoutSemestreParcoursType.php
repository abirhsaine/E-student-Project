<?php

namespace App\Form;

use App\Entity\Semestre;
use App\Entity\UE;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutSemestreParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Académique' => 'Académique',
                    'Césure' => 'Césure',
                    'Professionnel' => 'Professionnel',
                ],
                'label' => 'Type',
                'attr' => [
                    'class' => 'is-fullwidth',
                ],
            ])
            ->add('annee', IntegerType::class, [
                'attr' => [
                    'min' => date("Y"),
                    'max' => 2100
                ],
                'label' => 'Année',
                'attr' => [
                    'style' => 'width: 100%;',
                ],
            ])
            ->add('pair', CheckboxType::class, [
                'label' => 'Semestre paire',
                'required' => false
            ])
            ->add('ues', EntityType::class, [
                'class' => UE::class,
                'choice_label' => 'libelle',
                'multiple' => true,
                'label' => "Unités d'enseignements",
                'attr' => [
                    'class' => 'is-fullwidth',
                ],
                'required' => false
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Semestre::class,
        ]);
    }
}
