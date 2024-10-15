<?php

namespace domain\autopayment;

class PotentialPayment
{
    public function __construct(protected int $orderId, protected float $sum)
    {

    }
}