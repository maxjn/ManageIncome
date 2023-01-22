<?php

declare(strict_types=1); //To get error if we entered a wrong type

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR; //Our directory name with a /

//Declaring a constant for all the directories
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('DATA_PATH', $root . 'data' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

//Requiring a manin project codes

require APP_PATH . 'App.php';
require APP_PATH . 'helpers.php';

// get all the data files pathes using get_Data_Files(); function which is defined in App.php
$data_files = get_Files(DATA_PATH);

$datas = [];
foreach ($data_files as $file) {
    $datas = array_merge($datas, get_Data($file, 'extract_data'));
}

$totals = caculate_Totals($datas);

require VIEW_PATH . 'transactions.php';