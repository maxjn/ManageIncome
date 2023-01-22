<?php

declare(strict_types=1);

/**
 * Returns the amount with dollor formatting
 *
 * @param float $amount
 *
 * @return string $formated_amount
 */
function format_Dollor_Amount(float $amount): string
{

    $isNegative = $amount < 0.0;

    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}

/**
 * Returns the date with Jan 4,2023 formatting
 *
 * @param string $date
 *
 * @return string $formated_date
 */
function format_Date(string $date): string
{
    return date('F j, Y', strtotime($date));
}