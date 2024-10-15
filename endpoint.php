<?php

use domain\autopayment\AutoPaymentFactory;

$autoPayments = AutoPaymentFactory::getActiveAutoPayments();

foreach ($autoPayments as $autoPayment) {
    $potentialPayments = $autoPayment->getPotentialPayments();

    foreach ($potentialPayments as $potentialPayment) {
        \domain\payment\PaySystem::pay($potentialPayment->orderId, $potentialPayment->sum);
    }
}