<?php

namespace Acme\TimestampBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimestampsRegexType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('col1', 'date',
                array(
                    'label' => '日付1',
                    'required' => true,
                    'widget' => 'single_text',
                    'format' => 'yyyy/MM/dd',
                    /**
                     * pattern属性に対応していないブラウザだと意味が無い
                     */
                    'pattern' => '^[0-9]{4}/((0[13578]|1[02])/(0[1-9]|[12][0-9]|3[01])|(0[469]|11)/(0[1-9]|[12][0-9]|30)|02/(0[1-9]|[12][0-9]))$',
                    'invalid_message' => '日付1が正しくありません',
                ))
            ->add('col2', 'date',
                array(
                    'label' => '日付2',
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyyMMdd',
                    /**
                     * pattern属性に対応していないブラウザだと意味が無い
                     */
                    'pattern' => '^(19[0-9]{2}|2[0-9]{3})((0[13578]|1[02])(0[1-9]|[12][0-9]|3[01])|(0[469]|11)(0[1-9]|[12][0-9]|30)|02(0[1-9]|[12][0-9]))$',
                    'invalid_message' => '日付2が正しくありません',
                ))
        ;
    }
    public function getName()
    {
        return str_replace('\\', '_', strtolower(__CLASS__));
    }

}
