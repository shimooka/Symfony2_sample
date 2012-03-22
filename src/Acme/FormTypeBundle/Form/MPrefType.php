<?php

namespace Acme\FormTypeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * m_pref登録用Formクラス
 *
 * @version $Id$
 */
class MPrefType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('prefName', 'text', 
                array(
                    'label' => '都道府県名',
                    'required' => true,
                ))
            ->add('deleteFlag', 'choice',
                array(
                    'label' => '削除フラグ',
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
        return 'acme_formtypebundle_mpreftype';
    }
}
