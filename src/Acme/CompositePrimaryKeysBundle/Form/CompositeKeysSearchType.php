<?php

namespace Acme\CompositePrimaryKeysBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * composite_keys検索用Formクラス
 *
 * @version $Id$
 */
class CompositeKeysSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('key1', 'text',
                array(
                    'label' => '複合キー1',
                    'required' => false,
                ))
            ->add('key2', 'text',
                array(
                    'label' => '複合キー2',
                    'required' => false,
                ))
            ->add('name', 'text',
                array(
                    'label' => '名称',
                    'required' => false,
                ))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'csrf_protection' => false,
        );
    }

    public function getName()
    {
        return 'acme_compositeprimarykeysbundle_compositekeyssearchtype';
    }
}
