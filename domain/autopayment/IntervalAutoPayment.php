<?php

namespace domain\autopayment;

use Order;

class IntervalAutoPayment extends AutoPayment
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

    public function getPotentialPayments(): array
    {

        /** @var Order $orders */
        $orders = Order::whereRaw("
            WHERE (
                SELECT COUNT(*)
                FROM transactions AS t
                WHERE t.order_id = o.id
                AND t.rule_id = {$this->ruleId}
            ) < (
                NOW()::timestamp - o.created_at::timestamp / {$this->interval}
            )
        ");

        foreach ($orders as $order) {
            $potentialPaymentInstances[] = new PotentialPayment($order->id, $this->sum);
        }

        return $potentialPaymentInstances ?? [];
    }
}