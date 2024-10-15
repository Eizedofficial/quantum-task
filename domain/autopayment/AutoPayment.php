<?php

namespace domain\autopayment;

abstract class AutoPayment
{
    /**
     * @return PotentialPayment[]
     */
    abstract public function getPotentialPayments(): array;
}