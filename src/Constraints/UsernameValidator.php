<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * UsernameValidator.
 *
 * @author Marc Weistroff <marc@weistroff.net> 
 */
class UsernameValidator extends ConstraintValidator
{
    private static $list = [];

    public function validate($value, Constraint $constraint)
    {
        if (empty(static::$list)) {
            static::$list = require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'blacklist.php');
        }

        if (null === $value) {
            return;
        }

        if (in_array(strtolower($value), static::$list)) {
            $this->context->buildViolation($constraint->message)
                ->setCode(Username::IS_BLACKLISTED_ERROR)
                ->addViolation();

            return;
        }
    }
}
