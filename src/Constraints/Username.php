<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class Username extends Constraint
{
    const IS_BLOCKLISTED_ERROR = '688a57f3-a235-412c-9ea5-44d7d5c9d8a7';

    protected static $errorNames = [
        self::IS_BLOCKLISTED_ERROR => 'IS_BLOCKLISTED_ERROR',
    ];

    public $message = 'This value is not available';
}
