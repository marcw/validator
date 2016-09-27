<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class GoogleAnalytics extends Constraint
{
    public $message = "This is not a valid Google Analytics tracker ID.";

    const INVALID_ERROR = 'cd32c5b1-bb1a-45ba-90f3-709c5141ff1d';

    protected static $errorNames = array(
        self::INVALID_ERROR => 'INVALID_ERROR',
    );
}
