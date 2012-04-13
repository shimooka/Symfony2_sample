<?php

namespace Acme\TimestampBundle\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * date format validator.
 *
 * @author  SHIMOOKA Hideyuki <shimooka@doyouphp.jp>
 */
class DateFormatValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return true;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        $datetime = \DateTime::createFromFormat($constraint->pattern, $value);
        if ($datetime === false) {
            $this->setMessage($constraint->message, array(
                '{{ title }}' => $constraint->title,
                '{{ value }}' => $value,
            ));

            return false;
        } else if ($value !== $datetime->format($constraint->pattern)) {
            $this->setMessage($constraint->invalid, array(
                '{{ title }}' => $constraint->title,
                '{{ value }}' => $value,
            ));

            return false;
        }

        return true;
    }
}
