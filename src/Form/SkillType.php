<?php

namespace App\Form;

use App\Entity\Skill;
use App\Entity\SkillCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la compétence',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('skillCategories', EntityType::class, [
                'label' => 'Catégories',
                'class' => SkillCategory::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded'  => true,
                'constraints' => [
                    new Count(array(
                        'min' => 1,
                        'minMessage' => "Une compétence est associée à une ou plusieurs catégories."
                    ))
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
