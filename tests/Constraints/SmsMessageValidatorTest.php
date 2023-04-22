<?php

namespace Tests\MarcW\Validator\Constraints;

use MarcW\Validator\Constraints\SmsMessage;
use MarcW\Validator\Constraints\SmsMessageValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class SmsMessageValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new SmsMessageValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new SmsMessage());
        $this->assertNoViolation();
    }

    public function testBlankIsValid()
    {
        $this->validator->validate("", new SmsMessage());
        $this->assertNoViolation();
    }

    public function testSmallMessageIsValid()
    {
        $value = 'This is a small message that fits in one SMS.';
        $this->validator->validate($value, new SmsMessage());

        $this->assertNoViolation();
    }

    public function testLongMessageIsInvalidByDefault()
    {
        $value = 'This is a long message that does not fit in one SMS. I should try to shorten it but I am a bit lazy. Some say that lazyness is the recipe for a successful life. What do you think? What were we talking about already?';
        $constraint = new SmsMessage([
            'message' => 'myMessage',
        ]);
        $this->validator->validate($value, $constraint);

        $this->buildViolation('myMessage')
            ->setCode(SmsMessage::MAX_ERROR)
            ->setInvalidValue($value)
            ->setPlural(1)
            ->setParameter('{{ max }}', 1)
            ->assertRaised();
    }

    public function testLongMessageIsValidIfConfiguredCorrectly()
    {
        $value = 'This is a long message that does not fit in one SMS. I should try to shorten it but I am a bit lazy. Some say that lazyness is the recipe for a successful life. What do you think? What were we talking about already?';
        $this->validator->validate($value, new SmsMessage(['max' => 2]));

        $this->assertNoViolation();
    }
}
