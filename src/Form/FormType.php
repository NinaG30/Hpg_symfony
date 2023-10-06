<?php

namespace App\Form;

use App\Entity\FormData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('longueurToiture', NumberType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('largeurToiture', NumberType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('montantFacture', NumberType::class, [
                'constraints' => [new NotBlank()],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormData::class,
        ]);
    }
}
