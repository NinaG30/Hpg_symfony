<?php

namespace App\Form;

use App\Entity\FormData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', HiddenType::class, [
                'data' => $options['user'],
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',

                ],
                'label' => 'Votre nom',
                'constraints' => [new NotBlank()],
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',

                ],
                'label' => 'Votre prénom',
                'constraints' => [new NotBlank()],
            ])
            ->add('longueurToiture', NumberType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',

                ],
                'label' => 'Longueur de votre toiture (en mètre)',
                'constraints' => [new NotBlank()],
            ])
            ->add('largeurToiture', NumberType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    
                ],
                'label' => 'Largeur de votre toiture (en mètre)',
                'constraints' => [new NotBlank()],
            ])
            ->add('montantFacture', NumberType::class, [
                'attr' => [
                    'class' => 'form-control mb-3',
                    
                ],
                'label' => 'Montant de votre facture annuelle',
                'constraints' => [new NotBlank()],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormData::class,
            'user' => null,
        ]);
    }
}
