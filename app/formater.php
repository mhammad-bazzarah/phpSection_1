<?php

declare(strict_types=1);

function dollarFormat( float $amount): string{

        $isNegative = $amount <0;

        $newFormate = ($isNegative ? '-' : '') .'$'.  number_format(abs($amount),2) ;

        return $newFormate;

}


function dateFormate(string $date):string{

        return date('M j, Y', strtotime($date));
}