<?php

function formatPrice($amount){
    return number_format($amount, 2, ',', '.').'€ ';
}

