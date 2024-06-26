<?php

namespace Ljsharp\LaraSub\Traits;

use Ljsharp\LaraSub\Helpers\CarbonHelper;
use Ljsharp\LaraSub\Services\Period;

trait HasTrialPeriod
{
    /**
     * Trial total duration in specified interval.
     * @param string $interval
     * @return int
     * @throws \Exception
     */
    public function getTrialTotalDurationIn(string $interval): int
    {
        $trialPeriod = new Period($this->trial_interval, $this->trial_period);

        return $trialPeriod->getStartDate()->{CarbonHelper::diffIn($interval)}($trialPeriod->getEndDate());
    }

    /**
     * Check if entity has trial.
     *
     * @return bool
     */
    public function hasTrial(): bool
    {
        return $this->trial_period && $this->trial_interval;
    }
}
