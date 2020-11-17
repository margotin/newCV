<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => "Votre nom"
                ]
            ])
            ->add('adresseMail', EmailType::class, [
                'label' => 'Votre adresse email',
                'attr' => [
                    'placeholder' => "Votre adresse mail"
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'placeholder' => "Votre message"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
