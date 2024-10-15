<?php

namespace domain\autopayment;

use AutoPaymentType;

class AutoPaymentFactory
{
    /**
     * @return AutoPayment[]
     */
    public static function getActiveAutoPayments(): array
    {
        /** @var \AutoPayment[] $activeAutoPayments */
        $activeAutoPayments = [];
        /** @var AutoPayment $activeAutoPaymentsInstances */

        foreach($activeAutoPayments as $activeAutoPayment) {
            $activeAutoPaymentsInstances[] = self::getAutoPaymentInstance($activeAutoPayment->type);
        }

        return $activeAutoPaymentsInstances ?? [];
    }

    /**
     * @param AutoPaymentType $type
     * @return AutoPayment
     */
    private static function getAutoPaymentInstance(AutoPaymentType $type): AutoPayment
    {
        return match ($type) {
            AutoPaymentType::Interval => new IntervalAutoPayment(),
            AutoPaymentType::Single => new SingleAutoPayment()
        };
    }
}