<?php

namespace AppBundle\Form;
use AppBundle\Entity\Usr;
use AppBundle\Entity\Activite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PassType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


                /*->add('password', null, array(
                 'label' => 'input comment',
                 'attr' => array('style' => 'width: 200px')
               ));*/


            ->add('password',RepeatedType::class, [
              'type' => PasswordType::class,
              'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
              'options' => ['attr' => ['class' => 'password-field']],
              'required' => true,
              'first_options'  => ['label' => 'Nouveau mot de passe'],
              'second_options' => ['label' => 'Répéter le mot de passe'],]);





    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usr'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
