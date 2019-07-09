<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('birthday', BirthdayType::class, ['label' => 'Date de Naissance'])
            ->add('phoneNumber', TextType::class, ['label' => 'Téléphone'])
            ->add('postalAdress', TextType::class, ['label' => 'Adresse'])
            ->add('postalCode', TextType::class, ['label' => 'Code Postal'])
            ->add('town', TextType::class, ['label' => 'Ville'])
            ->add('insuranceCompany', TextType::class, ['label' => 'Compagnie d\'assurance'])
            ->add('insuranceNumber', TextType::class, ['label' => 'Numéro de sociétaire'])
            ->add('socialSecurityNumber', TextType::class, ['label' => 'Numéro Sécurité Sociale'])
            ->add('funding', ChoiceType::class, ['label' => 'Financement', 'choices' =>
                ['Region'=>'Region', 'Pole Emploi'=>'Pole Emploi', 'OPCA'=>'OPCA', 'Autofinancement'=>'Autofinancement', 'CPF'=>'CPF', 'CPF + Autofinancement'=>'CPF', 'Autre'=>'Autre']])
            ->add('poleEmploiId', TextType::class, ['label' => 'Identifiant Pole Emploi']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
