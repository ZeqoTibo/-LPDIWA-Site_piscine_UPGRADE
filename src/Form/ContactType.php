<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr'=>[
                    'placeholder' => 'Votre nom'
                ],
                'constraints'=>[
                    new NotBlank(),
                    new Regex(
                        array(
                            'pattern' =>'/^[a-zA-Z]+$/',
                            'message' => "Le nom est invalide !"
                        )
                    )
                ],
            ])

            ->add('prenom', TextType::class, [
                'attr'=>[
                    'placeholder' => 'Votre prénom'
                ],
                'constraints'=>[
                    new NotBlank(),
                    new Regex(
                        array(
                            'pattern' =>'/^[a-zA-Z]+$/',
                            'message' => "Le prénom est invalide !"
                        )
                    )
                ],
            ])

            ->add('cp', TextType::class,[
                'attr' =>[
                    'placeholder' => 'Ex : 53200'
                ],
                'constraints' =>[
                    new NotBlank(),
                    new Regex(
                        array(
                            'pattern' => '/[0-9]/',
                            'message' => "La code postal est invalide !"
                        )
                    ),
                    new Length(
                        [
                            'max' => 5,
                            'min' => 5,
                            'minMessage' => 'Le code postal doit seulement contenir 5 chiffres',
                            'maxMessage' => 'Le code postal doit seulement contenir 5 chiffres'

                        ]
                    )
                ]
            ])

            ->add('ville', TextType::class, [
                'attr'=>[
                    'placeholder' => 'Votre ville'
                ],
                'constraints'=>[
                    new NotBlank(),
                    new Regex(
                        array(
                            'pattern' =>'/^[a-zA-Z]+$/',
                            'message' => "La ville est invalide !"
                        )
                    )
                ]
            ])

            ->add('email', EmailType::class, [
                'attr' =>[
                    'placeholder' => 'exemple@mail.com'
                ],
                'constraints'=>[
                    new NotBlank(),
                ]

            ])

            ->add('tel', TelType::class, [
                'attr' =>[
                    'placeholder' => '0654346587'
                ],
                'constraints' =>[
                    new NotBlank(),
                    new Regex(
                        array(
                            'pattern' =>'/[0-9]/',
                            'message' => "Le numero est invalide !"
                        )
                    ),
                    new Length(
                        [
                            'max' => 11,
                            'min' => 10

                        ]
                    )
                ]
            ])
            ->add('envoyer', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

}
