<?php

namespace AppBundle\Form;
use AppBundle\Entity\Mot;
use AppBundle\Entity\Grammer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class WordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('motValeur',TextType::class, array('label' => 'valeur'))
            ->add('motGrammer',EntityType::class, [
                     'class' => Grammer::class,
                     'choice_label' => function(Grammer $gr) {
                         return sprintf('%s',  $gr->getGrammerNom());
                     },
                     'label' => 'Grammaire',
                     'placeholder' => 'sélectionner grammaire'
                 ]);






    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mot'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_Mot';
    }


}
