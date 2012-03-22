<?php

namespace Acme\FormTypeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * m_pref検索用Formクラス
 *
 * @version $Id$
 */
class MPrefSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('prefName', 'text',
                array(
                    'label' => '都道府県名',
                    'required' => false,
                ))
            ->add('deleteFlag', 'choice',
                array(
                    'label' => '削除フラグ',
                    'required' => false,
                    'choices' =>
                        array(
                            '0' => '有効',
                            '1' => '無効',
                        ),
                    'expanded' => true,
                    'multiple' => false,
                ))
        ;
    }

    public function getName()
    {
        return 'acme_formtypebundle_mprefsearchtype';
    }
}
