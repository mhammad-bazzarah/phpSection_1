<?php

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('AppPath' , $root . 'app' . DIRECTORY_SEPARATOR);
define('FilesPath' , $root . 'transactions_files' . DIRECTORY_SEPARATOR);
define('Views' , $root . 'views' . DIRECTORY_SEPARATOR);

require_once AppPath . 'app.php';
require_once AppPath . 'formater.php';

$files = getTransactionsFiles(FilesPath);
$transactions = [];
foreach ($files as $file ){
    $transactions = array_merge($transactions,getTransactions($file));
}

$totals = getTotals($transactions);


require_once Views . "transactions.php";