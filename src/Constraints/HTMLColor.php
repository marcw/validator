<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class HTMLColor extends Constraint
{
    public $message = "This is not a valid HTML color.";

    const INVALID_ERROR = 'f18f772c-a602-4f03-8e95-7bf48d0f7c90';

    protected static $errorNames = array(
        self::INVALID_ERROR => 'INVALID_ERROR',
    );
}
