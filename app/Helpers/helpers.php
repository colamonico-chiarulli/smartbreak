<?php

function formatPrice($amount)
{
    return number_format($amount, 2, ',', '.').' €';
}

function formatDate($date)
{
    return
        $date instanceof Carbon\Carbon ?
        $date->format('d/m/Y') :
        Carbon\Carbon::parse($date)->format('d/m/Y');
}
