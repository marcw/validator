<?php

namespace Tests\MarcW\Validator\Constraints;

use MarcW\Validator\Constraints\Username;
use MarcW\Validator\Constraints\UsernameValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;

class UsernameValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new UsernameValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Username());
        $this->assertNoViolation();
    }

    public function testBlankIsValid()
    {
        $this->validator->validate("", new Username());
        $this->assertNoViolation();
    }

    public function testNonBlacklistedIsValid()
    {
        $this->validator->validate("marc", new Username());
        $this->assertNoViolation();
    }

    public function testBlacklistedIsInvalid()
    {
        $value = 'admin';
        $this->validator->validate($value, new Username());

        $this->buildViolation('This value is not available')
            ->setCode(Username::IS_BLACKLISTED_ERROR)
            ->assertRaised();
    }
}
