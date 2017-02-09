<?php

namespace MarcW\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Marc Weistroff <marc@weistroff.net>
 */
class SmsMessage extends Constraint
{
    public $max = 1;
    public $message = 'This value is too long to be contained in {{ max }} SMS message.|This value is too long to be contained in {{ max }} SMS messages.';

    const MAX_ERROR = 'b66033bf-e12a-47ef-b6d3-963c5503f0fc';

    protected static $errorNames = [
        self::MAX_ERROR => 'MAX_ERROR',
    ];

}
