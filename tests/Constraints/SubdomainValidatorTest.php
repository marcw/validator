<?php

namespace Tests\MarcW\Validator\Constraints;

use MarcW\Validator\Constraints\Subdomain;
use MarcW\Validator\Constraints\SubdomainValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class SubdomainValidatorTest extends ConstraintValidatorTestCase
{
    public function createValidator()
    {
        return new SubdomainValidator();
    }

    public function testNullIsInvalid()
    {
        $this->validator->validate(null, new Subdomain());
        $this->buildViolation('This value should not be null.')
            ->setCode(Subdomain::IS_NULL_ERROR)
            ->assertRaised();
    }

    public function testBlankIsInvalid()
    {
        $this->validator->validate("", new Subdomain());
        $this->buildViolation('This value should not be blank.')
            ->setCode(Subdomain::IS_BLANK_ERROR)
            ->assertRaised();
    }

    /**
     * @dataProvider provideTestTooShortIsInvalid
     */
    public function testTooShortIsInvalid($value)
    {
        $this->validator->validate($value, new Subdomain());
        $this->buildViolation('This value is too short. It should be 3 characters long or more.')
            ->setCode(Subdomain::TOO_SHORT_ERROR)
            ->assertRaised();
    }

    public function provideTestTooShortIsInvalid()
    {
        return [
            ['a'],
            ['aa'],
        ];
    }

    /**
     * @dataProvider provideTestTooLongIsInvalid
     */
    public function testTooLongIsInvalid($value)
    {
        $this->validator->validate($value, new Subdomain());
        $this->buildViolation('This value is too long. It should be 63 characters long or less.')
            ->setCode(Subdomain::TOO_LONG_ERROR)
            ->assertRaised();
    }

    public function provideTestTooLongIsInvalid()
    {
        return [
            ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'],
            ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'],
        ];
    }

    public function testShouldNotStartWithAnHyphen()
    {
        $this->validator->validate("-foobar", new Subdomain());
        $this->buildViolation('This value cannot start with an hyphen.')
            ->setCode(Subdomain::HAS_HYPHEN_AT_START_ERROR)
            ->assertRaised();
    }

    public function testShouldNotEndWithAnHyphen()
    {
        $this->validator->validate("foobar-", new Subdomain());
        $this->buildViolation('This value cannot end with an hyphen.')
            ->setCode(Subdomain::HAS_HYPHEN_AT_END_ERROR)
            ->assertRaised();
    }

    public function testShouldBeCorrectlyFormated()
    {
        $this->validator->validate("foo_bar", new Subdomain());
        $this->buildViolation('This value cannot contain anything else than alphanumeric characters and hyphens.')
            ->setCode(Subdomain::REGEX_FAILED_ERROR)
            ->assertRaised();
    }

    public function testShouldBeCorrectlyFormatedr3()
    {
        $this->validator->validate("foo.bar", new Subdomain());
        $this->buildViolation('This value cannot contain anything else than alphanumeric characters and hyphens.')
            ->setCode(Subdomain::REGEX_FAILED_ERROR)
            ->assertRaised();
    }

    /**
     * @dataProvider provideTestCorrectSubdomain
     */
    public function testCorrectSubdomain($value)
    {
        $this->validator->validate($value, new Subdomain());
        $this->assertNoViolation();
    }

    public function provideTestCorrectSubdomain()
    {
        return [
                ['www'],
                ['w-w-w'],
                ['www3'],
                ['34www'],
                ['3-4-www'],
                ['3-4-w-w-w'],
        ];
    }
}
