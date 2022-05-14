<?php

declare(strict_types=1);

function getTransactionsFiles( string $path) :array {

    $files=[];

    foreach(scandir($path) as $file){
        if(is_dir($file)){
            continue;
        }

        $files[]= $path . $file;
    }

    return $files;

} 

function getTransactions(string $fileName):array{

        if(! file_exists($fileName)){
            trigger_error('File' . $fileName . 'does not exists',E_USER_ERROR);
        }

        $transactions = [];

        $file =  fopen($fileName, 'r');

        fgetcsv($file);

        while( ($transaction = fgetcsv($file)) !== false){
            $transactions[] = extractTransactions($transaction) ;
        }

        return $transactions;
}

function extractTransactions(array $transactionsRow): array{

    [$date, $checkNumber , $description , $amount] = $transactionsRow;

    $amount = (float) str_replace([',','$'],'',$amount);
           
    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount,
    ];
}

function getTotals(array $transactions):array  {

    $totals = ['netTotal' => 0 , 'totalIncome' => 0 ,'totalExpense'=> 0  ];

    foreach($transactions as $transaction ){
        $totals['netTotal'] += $transaction['amount'];

        $transaction['amount'] >= 0 ? 
            $totals['totalIncome'] +=  $transaction['amount'] :
            $totals['totalExpense'] +=  $transaction['amount'];

    }
    
    return $totals;

}

function format(array $transactions){
    
    




}