<?php

namespace Acme\TimestampBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimestampsConstraintType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('col1Temporary', 'text',
                array(
                    'label' => '日付1',
                    'required' => true,
                    'pattern' => '^(19[0-9]{2}|2[0-9]{3})/((0[13578]|1[02])/(0[1-9]|[12][0-9]|3[01])|(0[469]|11)/(0[1-9]|[12][0-9]|30)|02/(0[1-9]|[12][0-9]))$',
                    'invalid_message' => '{{ title }}はYYYY/MM/DD形式で入力してください',
                ))
            ->add('col2Temporary', 'text',
                array(
                    'label' => '日付2',
                    'required' => false,
                    'pattern' => '^(19[0-9]{2}|2[0-9]{3})((0[13578]|1[02])(0[1-9]|[12][0-9]|3[01])|(0[469]|11)(0[1-9]|[12][0-9]|30)|02(0[1-9]|[12][0-9]))$',
                    'invalid_message' => '{{ title }}はYYYY/MM/DD形式で入力してください',
                ))
/*
            ->add('col3', 'date',
                array(
                    'label' => '日付3',
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyyMMdd',
                    'pattern' => '^(19[0-9]{2}|2[0-9]{3})((0[13578]|1[02])(0[1-9]|[12][0-9]|3[01])|(0[469]|11)(0[1-9]|[12][0-9]|30)|02(0[1-9]|[12][0-9]))$',
                    'invalid_message' => '日付が正しくありません',
                ))
*/
        ;
    }
    public function getName()
    {
        return str_replace('\\', '_', strtolower(__CLASS__));
    }

}
