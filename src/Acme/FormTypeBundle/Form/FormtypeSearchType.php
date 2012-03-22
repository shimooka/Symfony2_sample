<?php

namespace Acme\FormTypeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * formtype検索用Formクラス
 *
 * @version $Id$
 */
class FormtypeSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title', 'text',
                array(
                    'label' => '氏名',
                    'required' => false,
                ))
            ->add('prefecture', 'text',
                array(
                    'label' => '都道府県コード1',
                    'required' => false,
                ))
            ->add('gender', 'text',
                array(
                    'label' => '性別',
                    'required' => false,
                ))
            ->add('registerDate1', 'text',
                array(
                    'label' => '登録日1',
                    'required' => false,
                ))
            ->add('registerDate2', 'text',
                array(
                    'label' => '登録日2',
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
        return 'acme_formtypebundle_formtypesearchtype';
    }
}
