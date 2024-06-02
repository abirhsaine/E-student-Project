<?php

namespace App\Form;

use App\Entity\UEValide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UEValideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valide')
            ->add('ineetudiant')
            ->add('idsemestre')
            ->add('codeue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UEValide::class,
        ]);
    }
}
