<?php

declare(strict_types=1);

namespace Ljsharp\LaraSub\Services;

use Carbon\Carbon;
use Ljsharp\LaraSub\Models\Plan;
use Ljsharp\LaraSub\Models\PlanCombination;

/**
 * Class SubscriptionPeriod.
 *
 * Intermediate class to calculate subscription periods accounting trial
 */
class SubscriptionPeriod
{
    protected $trialEnd = null;
    protected $start = null;
    protected $end = null;

    protected $plan;
    protected $startDate;

    public function __construct(Plan|PlanCombination $plan, Carbon $startDate)
    {
        $this->plan = $plan;
        $this->startDate = $startDate;

        if ($this->plan->trial_period > 0) {
            $this->setTrialPeriod();
        } else {
            $this->setSubscriptionPeriod();
        }
    }

    /**
     * Get start date.
     *
     * @return Carbon|null
     */
    public function getStartDate()
    {
        return $this->start;
    }

    /**
     * Get end date.
     *
     * @return Carbon
     */
    public function getEndDate()
    {
        return $this->end;
    }

    /**
     * Get trial end date.
     *
     * @return Carbon
     */
    public function getTrialEndDate()
    {
        return $this->trialEnd;
    }

    /**
     * Set trial period based on plan data.
     */
    private function setTrialPeriod()
    {
        $trial = new Period($this->plan->trial_interval, $this->plan->trial_period, $this->startDate);
        $this->trialEnd = $trial->getEndDate();
    }

    /**
     * Set subscription period.
     */
    private function setSubscriptionPeriod()
    {
        $period = new Period($this->plan->invoice_interval, $this->plan->invoice_period, $this->startDate);
        $this->start = $period->getStartDate();
        $this->end = $period->getEndDate();
    }
}
