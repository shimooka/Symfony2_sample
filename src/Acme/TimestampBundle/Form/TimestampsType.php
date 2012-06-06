<?php

namespace Acme\TimestampBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TimestampsType extends AbstractType
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
                    'invalid_message' => '日付1が正しくありません',
                ))
            ->add('col2', 'date',
                array(
                    'label' => '日付2',
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyyMMdd',
                    'invalid_message' => '日付2が正しくありません',
                ))
        ;
    }
    public function getName()
    {
        return str_replace('\\', '_', strtolower(__CLASS__));
    }

}
