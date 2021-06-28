<?php

namespace AppBundle\Form;
use AppBundle\Entity\Grammer;
use AppBundle\Entity\Activite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class GrammerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('grammerNom',TextType::class, array('label' => 'Nom de Grammaire'))
            ->add('grammerActivite',EntityType::class, [
                     'class' => Activite::class,
                     'choice_label' => function(Activite $gract) {
                         return sprintf('%s',  $gract->getActivite());
                     },
                     'label' => 'Activité de Grammaire',
                     'placeholder' => 'sélectionnez activité'
                 ]);




    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Grammer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_Grammer';
    }


}
