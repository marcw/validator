<?php

namespace Tests\MarcW\Validator\Constraints;

use MarcW\Validator\Constraints\GoogleAnalytics;
use MarcW\Validator\Constraints\GoogleAnalyticsValidator;
use Symfony\Component\Validator\Test\A;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class GoogleAnalyticsValidatorTest extends ConstraintValidatorTestCase
{
    public function createValidator()
    {
        return new GoogleAnalyticsValidator();
    }

    /**
     * @dataProvider provideInvalidTrackerIDs
     */
    public function testInvalidTrackerIDs($value)
    {
        $this->validator->validate($value, new GoogleAnalytics());
        $this->buildViolation('This is not a valid Google Analytics tracker ID.')
            ->setCode(GoogleAnalytics::INVALID_ERROR)
            ->assertRaised();
    }

    public function provideInvalidTrackerIDs()
    {
        return [
            ['UA-1234-'],
            ['UA--1'],
            ['ua-1234-'],
            ['ua--1'],
            ['Ua-1234-'],
            ['Ua--1'],
            ['uA-1234-'],
            ['uA--1'],
        ];
    }

    /**
     * @dataProvider provideValidTrackerIDs
     */
    public function testValidTrackerIDs($value)
    {
        $this->validator->validate($value, new GoogleAnalytics());
        $this->assertNoViolation();
    }

    public function provideValidTrackerIDs()
    {
        return [
            ['UA-1234-12'],
            ['uA-1234-12'],
            ['ua-1234-12'],
            ['Ua-1234-12'],
            ['YT-1234-12'],
            ['Yt-1234-12'],
            ['yt-1234-12'],
            ['yT-1234-12'],
            ['MO-1-1'],
            ['mo-1-1'],
            ['Mo-1-1'],
            ['mO-1-1'],
            ['UA-1234-1'],
            ['ua-1-1'],
        ];
    }
}
