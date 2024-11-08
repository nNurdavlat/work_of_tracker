<?php

// require 'DB.php';
// $db = new DB();  Hammasini commetga olamiz chunki WorkDay.php ichida DB.php kodlari bor
// $pdo = $db->pdo;
require 'WorkDay.php';
$workDay = new WorkDay();

if (isset($_POST['kelgan_vaqt']) and isset($_POST['ketgan_vaqt']) and isset($_POST['ism'])) {
    if (!empty($_POST['ism']) and !empty($_POST['kelgan_vaqt']) and !empty($_POST['ketgan_vaqt'])) {
        $workDay->strory($_POST['ism'], $_POST['kelgan_vaqt'], $_POST['ketgan_vaqt']);
    }
}

$records = $workDay->getWordDayList();

require 'view.php';
