<?php

// Le Type définit la structure et les contraintes du formulaire

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $descriptionMaxLength = 200;

        $builder
            // Title
            ->add('title', TextType::class, [

                // Label options
                'label' => "Titre du livre",
                // 'label_attr' => [
                //     'class' => "my-awesome-style",
                // ],

                // Make it required
                'required' => true,
                
                // Field attributes
                'attr' => [
                    // 'class' => "my-awesome-style",
                    'placeholder' => "Saisir le titre du livre"
                ],

                // Field helper
                'help' => "Saisir le titre du livre",
                'help_attr' => [
                    // 'class' => "my-awesome-style"
                ],

                // Form constraints
                'constraints' => [
                    new NotBlank([
                        'message' => "Le titre est obligatoire"
                    ])
                ]
            ])

            // Description
            ->add('description', TextareaType::class, [

                // Label options
                'label' => "Description du livre",
                // 'label_attr' => [
                //     'class' => "my-awesome-style",
                // ],

                // Make it required
                'required' => false,
                
                // Field attributes
                'attr' => [
                    // 'class' => "my-awesome-style",
                    'placeholder' => "Saisir la description du livre",
                    'maxLength' => $descriptionMaxLength
                ],

                // Field helper
                'help' => "Saisir une description de $descriptionMaxLength caractères max",
                'help_attr' => [
                    // 'class' => "my-awesome-style"
                ],

                // Form constraints
                'constraints' => [
                    new Length(
                        max: $descriptionMaxLength,
                        maxMessage: "La description est trop long... {{ limit }} max !"
                    )
                ]
            ])

            // Cover
            ->add('cover', FileType::class, [

                // Label options
                'label' => "Couverture du livre",
                // 'label_attr' => [
                //     'class' => "my-awesome-style",
                // ],

                'mapped' => false,

                // Make it required
                'required' => false,
                
                // Field attributes
                'attr' => [
                    // 'class' => "my-awesome-style",
                    'accept' => "image/*"
                ],

                // Field helper
                'help' => "Choisir une image pour la couverture du livre",
                'help_attr' => [
                    // 'class' => "my-awesome-style"
                ],

                // Form constraints
                'constraints' => [
                    new File([
                        'maxSize' => "1024k",
                        'maxSizeMessage' => "Le fichier est trop lourd. ({{ limit }} max)",
                        'mimeTypes' => [
                            "image/gif",
                            "image/jpeg",
                            "image/png",
                        ],
                        'mimeTypesMessage' => "Le format de fichier n'est pas autorisé"
                    ])
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}