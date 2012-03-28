<?php

namespace Acme\CompositePrimaryKeysBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * composite_keys登録用Formクラス
 *
 * @version $Id$
 */
class CompositeKeysType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('key1', 'text',
                array(
                    'label' => '複合キー1',
                    'required' => true,
                    'pattern' => '^[0-9]{2}$',
                ))
            ->add('key2', 'text',
                array(
                    'label' => '複合キー2',
                    'required' => true,
                    'pattern' => '^[0-9]{2}$',
                ))
            ->add('name', 'text',
                array(
                    'label' => '名称',
                    'required' => true,
                ))
        ;
    }

    public function getName()
    {
        return 'acme_compositeprimarykeysbundle_compositekeystype';
    }
}
