<?php

namespace Tests\MarcW\Validator\Constraints;

use MarcW\Validator\Constraints\HTMLColor;
use MarcW\Validator\Constraints\HTMLColorValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class HTMLColorValidatorTest extends ConstraintValidatorTestCase
{
    public function createValidator()
    {
        return new HTMLColorValidator();
    }

    /**
     * @dataProvider provideInvalidColors
     */
    public function testInvalidColors($value)
    {
        $this->validator->validate($value, new HTMLColor());
        $this->buildViolation('This is not a valid HTML color.')
            ->setCode(HTMLColor::INVALID_ERROR)
            ->assertRaised();
    }

    public function provideInvalidColors()
    {
        return [
            ['#e'],
            ['bcdef'],
            ['#7fdc'],
            ['#3x239'],
            ['#e-sdf90'],
            ['#FF660'],
        ];
    }

    /**
     * @dataProvider provideValidColors
     */
    public function testValidColors($value)
    {
        $this->validator->validate($value, new HTMLColor());
        $this->assertNoViolation();
    }

    public function provideValidColors()
    {
        return [
            ['#ffddee'],
            ['#abcdef'],
            ['#C67fdc'],
            ['#239'],
            ['#e90'],
            ['#FF6600'],
        ];
    }
}
