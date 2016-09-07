<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * SubdomainValidator.
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class SubdomainValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Subdomain) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\Subdomain');
        }

        if (null === $value) {
            $this->context->buildViolation($constraint->notNullMessage)
                ->setCode(Subdomain::IS_NULL_ERROR)
                ->addViolation();

            return;
        }

        if (false === $value || (empty($value) && '0' != $value)) {
            $this->context->buildViolation($constraint->notBlankMessage)
                ->setCode(Subdomain::IS_BLANK_ERROR)
                ->addViolation();

            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;
        $value = strtolower($value);
        $length = mb_strlen($value, 'UTF-8');

        if ($length > 63) {
            $this->context->buildViolation($constraint->maxMessage)
                ->setCode(Subdomain::TOO_LONG_ERROR)
                ->addViolation();

            return;
        }

        if ($length < 3) {
            $this->context->buildViolation($constraint->minMessage)
                ->setCode(Subdomain::TOO_SHORT_ERROR)
                ->addViolation();

            return;
        }

        if ('-' === substr($value, 0, 1)) {
            $this->context->buildViolation($constraint->hyphenStartMessage)
                ->setCode(Subdomain::HAS_HYPHEN_AT_START_ERROR)
                ->addViolation();
        }

        if ('-' === substr($value, -1, 1)) {
            $this->context->buildViolation($constraint->hyphenEndMessage)
                ->setCode(Subdomain::HAS_HYPHEN_AT_END_ERROR)
                ->addViolation();
        }

        if (true xor preg_match('/^[a-z-0-9][a-z-0-9-]+[a-z-0-9]$/', $value)) {
            $this->context->buildViolation($constraint->regexFailedMessage)
                ->setCode(Subdomain::REGEX_FAILED_ERROR)
                ->addViolation();
        }
    }
}
