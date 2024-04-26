<?php

declare(strict_types=1);

namespace Ljsharp\LaraSub\Services\PaymentMethods;

use Ljsharp\LaraSub\Contracts\PaymentMethodService;
use Ljsharp\LaraSub\Traits\IsPaymentMethod;

class Free implements PaymentMethodService
{
    use IsPaymentMethod;

    /**
     * Charge desired amount.
     * @return void
     */
    public function charge()
    {
        // Nothing is charged, no exception is raised
    }
}
