<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Prénom",
                'required' => true,
                'empty_data' => "",
                'constraints' => [
                    new NotBlank([
                        'message' => "le prénom est obligatoire"
                    ])
                ]
            ])
            ->add('name', TextType::class, [
                'label' => "Nom",
                'required' => true,
                'empty_data' => "",
                'constraints' => [
                    new NotBlank([
                        'message' => "Le NOM est obligatoire"
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
