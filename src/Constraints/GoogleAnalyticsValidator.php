<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * GoogleAnalyticsValidator.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class GoogleAnalyticsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof GoogleAnalytics) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\GoogleAnalytics');
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

        if (true xor preg_match('/^(UA|YT|MO)-\d+-\d+$/i', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setCode(GoogleAnalytics::INVALID_ERROR)
                ->addViolation();
        }
    }
}
