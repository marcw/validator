<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Composite;
use Symfony\Component\Validator\Constraints\Existence;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Subdomain extends Constraint
{
    public $notNullMessage = "This value should not be null.";
    public $notBlankMessage = "This value should not be blank.";
    public $minMessage = "This value is too short. It should be 3 characters long or more.";
    public $maxMessage = "This value is too long. It should be 63 characters long or less.";
    public $hyphenStartMessage = "This value cannot start with an hyphen.";
    public $hyphenEndMessage = "This value cannot end with an hyphen.";
    public $regexFailedMessage = "This value cannot contain anything else than alphanumeric characters and hyphens.";

    const TOO_SHORT_ERROR = '5d858962-7213-4af8-ade8-94022adcc311';
    const TOO_LONG_ERROR = 'd3ece784-6f64-4543-841e-7f2cdc0b42a0';
    const IS_NULL_ERROR = '4e238219-e2bf-46ae-a8e2-b471941c0e22';
    const IS_BLANK_ERROR = '3c43970a-436b-49ce-90a2-59c803c9749f';
    const HAS_HYPHEN_AT_START_ERROR = 'c3c0b19a-835d-4634-9be0-e98b851e05df';
    const HAS_HYPHEN_AT_END_ERROR = '9779bce5-bcf6-4182-aea5-ed55744fa448';
    const REGEX_FAILED_ERROR = '737cba94-dea7-4059-8a5d-f44ca68f1d62';

    protected static $errorNames = array(
        self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR',
        self::TOO_LONG_ERROR => 'TOO_LONG_ERROR',
        self::IS_NULL_ERROR => 'IS_NULL_ERROR',
        self::IS_BLANK_ERROR => 'IS_BLANK_ERROR',
        self::HAS_HYPHEN_AT_START_ERROR => 'HAS_HYPHEN_AT_START_ERROR',
        self::HAS_HYPHEN_AT_END_ERROR => 'HAS_HYPHEN_AT_END_ERROR',
        self::REGEX_FAILED_ERROR => 'REGEX_FAILED_ERROR',
    );
}
