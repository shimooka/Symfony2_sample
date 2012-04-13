<?php

namespace Acme\TimestampBundle\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Annotation for date format validation.
 *
 * @author  SHIMOOKA Hideyuki <shimooka@doyouphp.jp>
 * @Annotation
 */
class DateFormat extends Constraint
{
    public $message = 'This format is not valid';
    public $invalid = 'This date is not valid';
    public $pattern = 'Y-m-d';
    public $title;

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return array();
    }

    /**
     * {@inheritDoc}
     */
    public function getRequiredOptions()
    {
        return array();
    }
}
