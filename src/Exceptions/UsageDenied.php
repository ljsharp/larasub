<?php

namespace Ljsharp\LaraSub\Exceptions;

class UsageDenied extends LaravelLaraSubException
{
    public function __construct($featureTag = '')
    {
        $message = "Usage of '{$featureTag}' has been denied.";

        parent::__construct($message);
    }
}
