<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Responsable;
use App\Entity\UE;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UEType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'Code',
            ])
            ->add('modalite', ChoiceType::class, [
                'choices' => [
                    'Majeure' => 'Maj',
                    'Mineure' => 'Min'
                ],
                'attr' => [
                    'class' => 'is-fullwidth',
                ],
                'label' => 'Modalité',
            ])
            ->add('libelle', TextType::class, [
                'label' => 'Libellé',
            ])
            ->add('capacite', IntegerType::class, [
                'label' => 'Capacité',
                'attr' => [
                    'min' => 0,
                    'max' => 300,
                ]
            ])
            ->add('responsable', EntityType::class, [
                'class' => Responsable::class,
                'choice_label' => function ($responsable) {
                    return $responsable->getPrenom() . ' ' . $responsable->getNom();
                },
                'attr' => [
                    'class' => 'is-fullwidth',
                ]
            ])
            ->add('modules', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'libelle',
                'multiple' => true,
                'attr' => [
                    'class' => 'is-fullwidth',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UE::class,
        ]);
    }
}
