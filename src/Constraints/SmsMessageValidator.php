<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Instasent\SMSCounter\SMSCounter;

/**
 * SmsMessageValidator.
 *
 * @author Marc Weistroff <marc@weistroff.net> 
 */
class SmsMessageValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof SmsMessage) {
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

        $smsCounter = new SMSCounter();
        $result = $smsCounter->count($value);

        if ($result->messages > $constraint->max) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ max }}', $constraint->max)
                ->setPlural((int) $constraint->max)
                ->setInvalidValue($value)
                ->setCode(SmsMessage::MAX_ERROR)
                ->addViolation();

            return;
        }
    }
}
