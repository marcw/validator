# Validator

[![Build Status](https://travis-ci.org/marcw/validator.svg?branch=master)](https://travis-ci.org/marcw/validator)
[![Coverage Status](https://coveralls.io/repos/github/marcw/validator/badge.svg?branch=master)](https://coveralls.io/github/marcw/validator?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/75cf3a3f-a16d-4f05-a3e8-46b190b4daf5/mini.png)](https://insight.sensiolabs.com/projects/75cf3a3f-a16d-4f05-a3e8-46b190b4daf5)

Some additions to the [Validator Symfony Component](github.com/symfony/symfony).

## Subdomain validation

Validate a string value based on these rules:

- Be not null.
- Be not blank.
- Be more than or equal to 3 characters.
- Be less than 63 characters.
- Be in alphanumeric and hyphen.
- Do not start with an hyphen.
- Do not end with an hyphen.


## Username validation

Validate a string value based on [The Big Username
Blocklist](https://github.com/marteinn/The-Big-Username-Blocklist). It won't
validate if the value is equal to one of these terms.

## GoogleAnalytics Tracker ID validation

Validate that a string matches the correct format for a Google Analytics Tracker ID.

## SMS Message Validation.

Validate that a value fits in one (or more) SMS message.

## HTMLColor validator

Validate that a string matches the basic HTML format for a color (`#abc` or `#abcdef`)

## Example

```php
<?php

namespace AppBundle\Entity;

use MarcW\Validator\Constraints as Assert;

class User
{
    /**
     * The username is used to attribute a subdomain or a subfolder to the user like:
     * https://username.acme.com or https://acme.com/username
     * @Assert\Subdomain
     * @Assert\Username
     */
    private $username;

    /**
     * @Assert\GoogleAnalytics
     */
    private $googleAnalytics;

    /**
     * @Assert\HTMLColor
     */
    private $backgroundColor;
}

class Message
{
    /**
     * This value must fit in 2 SMS messages.
     *
     * @Assert\SmsMessage(max=2)
     */
    private $body;
}
```

For more information, please read the [Symfony Validator component official documentation](http://symfony.com/doc/current/components/validator.html).

## Install

```
composer require marcw/validator
```

## Can I contribute?

Sure! Feel free to report issues, send pull-requests, or ask for help.

## LICENSE

See the [LICENSE](/LICENSE) file.

