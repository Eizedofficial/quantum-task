<?php

enum AutoPaymentType: string
{
    case Interval = 'interval';
    case Single = 'single';
}