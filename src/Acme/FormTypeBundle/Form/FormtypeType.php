<?php

namespace Acme\FormTypeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Acme\FormTypeBundle\Entity\MPrefRepository;

/**
 * formtype登録用Formクラス
 *
 * @version $Id$
 */
class FormtypeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title', 'text',
                array(
                    'label' => '氏名',
                    'required' => true,
                ))
            /**
             * サービスに登録したFormType"pref"を利用する
             */
            ->add('prefecture', 'pref',
                array(
                    'label' => '都道府県2',
                    'required' => false,
                ))
            /**
             * サービスに登録したFormType"gender"を利用する
             */
            ->add('gender', 'gender',
                array(
                    'label' => '性別',
                    'required' => true,
                ))
            ->add('registerDate1', 'date',
                array(
                    'label' => '登録日1',
                    'required' => true,
                    'widget' => 'single_text',
                    'format' => 'yyyyMMdd',
                    'pattern' => '^[12][0-9]{3}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])$',
                    'invalid_message' => '日付が正しくありません'
                ))
            ->add('registerDate2', 'date',
                array(
                    'label' => '登録日2',
                    'required' => true,
                    'widget' => 'single_text',
                    'format' => 'yyyy/MM/dd',
                    'input' => 'string',
                    'pattern' => '^[12][0-9]{3}/(0[1-9]|1[0-2])/(0[1-9]|[12][0-9]|3[01])$',
                    'invalid_message' => '日付が正しくありません'
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
        return 'acme_formtypebundle_formtypetype';
    }
}
