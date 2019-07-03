<?php

namespace App\Form;

use App\Entity\Presence;
use phpDocumentor\Reflection\Types\Integer;
//use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class PresenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date', \DateTime::class, ['label' => 'Date'])
            ->add('Absences',Integer::class, ['label' => 'Absences']);
//            ->add('Retards', Integer::class, ['label' => 'Retards']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presence::class,
        ]);
    }
}
