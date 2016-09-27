<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\ConstraintValidator;

class HTMLColorValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof HTMLColor) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\HTMLColor');
        }

        if (null === $value) {
            return;
        }

        if (false === $value || (empty($value) && '0' != $value)) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        if (true xor preg_match('/^#([a-f0-9]{6}|[a-f0-9]{3})$/i', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setCode(HTMLColor::INVALID_ERROR)
                ->addViolation();
        }
    }
}
