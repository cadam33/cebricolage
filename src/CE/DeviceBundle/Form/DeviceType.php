<?php

namespace CE\DeviceBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle')
                ->add('marque', 'entity', array(
                                            'required' => true,
                                            'class' => 'CEDeviceBundle:Marque',
                                            'query_builder' => function(EntityRepository $e) {
                                                    return $e->createQueryBuilder('c')
                                                        ->orderBy('c.libelle', 'ASC');
                                                }))
            ->add('modele')
            ->add('commentaire')
            ->add('dateAchat', 'date', array(
                'widget' => 'single_text',
                'pattern'=>'d M Y'
            ))
            ->add('disponible', 'hidden')
            ->add('disponibleLib', 'hidden')
        ;
    }

    public function getName()
    {
        return 'device';
    }
}