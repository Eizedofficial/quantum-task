<?php

namespace domain\autopayment;

use domain\autopayment\AutoPayment;
use Order;

class SingleAutoPayment extends AutoPayment
{
    private int $interval;
    private float $sum;
    private int $ruleId;

    public function __construct(\AutoPayment $model)
    {
        $this->interval = $model->interval;
        $this->sum = $model->sum;
        $this->ruleId = $model->ruleId;
    }

    /**
     * @return PotentialPayment[]
     */
    public function getPotentialPayments(): array
    {
        /** @var Order $orders */
        $orders = Order::whereDoesntHave(
            \Transaction::class, [
                'rule_id' => $this->ruleId
            ]
        )
            ->where("
            NOW()::timestamp - created_at::timestamp >= {$this->interval}
        ");

        foreach ($orders as $order) {
            $potentialPaymentInstances[] = new PotentialPayment($order->id, $this->sum);
        }

        return $potentialPaymentInstances ?? [];
    }
}