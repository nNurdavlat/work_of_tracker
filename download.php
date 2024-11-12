<?php

if (isset($_POST['export'])) {
    require 'WorkDay.php';
    $workday = new WorkDay();

    $records = $workday -> getWordDayList();

    $output = fopen('php://output', 'w');

    $columns = ['#', 'Ism', 'Kelgan', 'Ketgan', 'Qarizdorlik'];

    
    fputcsv($output, $columns);
    $i = 0;
    foreach ($records as $record){
        $i++;
        $record['id'] = $i;
        $record['required_of'] = gmdate('H:i', $record['required_of']);
        fputcsv($output, $record);
    }

    $filename = 'Daily.csv';

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');
}