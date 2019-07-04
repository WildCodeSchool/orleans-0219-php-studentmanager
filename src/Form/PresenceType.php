<?php

namespace App\Form;

use App\Entity\Presence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, ['label' => 'Date'])
            ->add('user', EntityType::class, [
                'class' => PresenceType::class,
                'choice_label' => 'username',
                'label' => 'User'])
//            ->add('Heures', IntegerType::class, ['label' => 'Heures'])
//            ->add('Justificatif ?', CheckboxType::class, ['label' => 'Justificatif ?'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
