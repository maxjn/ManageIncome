<?php

declare(strict_types=1);


/**
 * Returns all the files' paths from the given directory
 *
 * @param string $directory
 *
 * @return array $files all the files with their paths
 */
function get_Files(string $dirPath): array
{

    $files = []; // all the data files paths
    foreach (scandir($dirPath) as $file) {

        if (is_dir($file)) {
            continue;
        } else {
            $files[] = $dirPath . $file;
        }
    }

    return $files;
}

/**
 * Returns all the datas from a csv file
 *
 * @param string $filePath path to the csv file
 * @param callable $dataHandler to extract the data
 *
 * @return array $datas all the datas from the csv file
 */
function get_Data(string $filePath, ?callable $dataHandler = null): array
{

    if (!file_exists($filePath)) {
        trigger_error("File '$filePath' does not exist", E_USER_ERROR);
    }

    $file = fopen($filePath, 'r');

    fgetcsv($file); //to get read of header line

    $datas = [];

    while (($data = fgetcsv($file)) !== false) {
        if ($dataHandler !== null) {
            $data = $dataHandler($data);
        }
        $datas[] = $data;
    }

    return $datas;
}

/**
 * Returns all the datas from a csv file
 *
 * @param array $data line of data
 *
 * @return array $extracted extracted data
 */
function extract_data(array $data): array
{

    [$date, $checkNumber, $description, $amount] = $data;

    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date'        => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount'      => $amount,
    ];
}

/**
 * Loops through datas and calculates 'Total Income','Net Income','TotalExpense'
 *
 * @param array $datas
 *
 * @return array $totals An array of calculated 'Total Income','Net Income','TotalExpense'
 */
function caculate_Totals(array $datas): array
{

    $totals = ['netTotals' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($datas as $data) {

        $totals['netTotals'] += $data['amount'];
        if ($data['amount'] >= 0) {
            $totals['totalIncome'] += $data['amount'];
        } else {
            $totals['totalExpense'] += $data['amount'];
        }
    }

    return $totals;
}