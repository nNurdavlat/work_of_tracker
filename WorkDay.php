<?php

require 'DB.php';

class WorkDay
{
    const IshlashKerak = 8;

    public $pdo;

    public function __construct()
    {
        $db = new DB();
        $this->pdo = $db->pdo;
    }


    public function strory(
        string $name,
        string $arrived_at,
        string $leaved_at
    ) {   // Agar qavs ichiga o'zgaruvchi yozmasak front-end dan kevotgan malumotni ushlab ololmimiz


        // $ism = $_POST['ism']; (Nimaga o'chirdik chunki front-enddan ma'lumotni ovomiz)
        $kelgan_vaqt = new DateTime($arrived_at);  // $arrived_at ni vaqt ko'rinishida yozvomiz $kelgan_vaqt ga
        $ketgan_vaqt = new DateTime($leaved_at); // $leaved_at ni vaqt ko'rinishida yozvomiz $ketgan_vaqt ga


        //Orasidagi vaqt hisoblash uchun diff methodi yordamga keladi
        $diff = $kelgan_vaqt->diff($ketgan_vaqt);
        $hour = $diff->h;
        $minute = $diff->i;
        $total = ((self::IshlashKerak * 3600) - (($hour * 3600) + ($minute * 60)));

        $quary = "INSERT INTO work_times(kelgan_vaqt, ketgan_vaqt, ism, required_of) VALUES (:kelgan, :ketgan, :ism, :qarzi)";

        $stmt = $this->pdo->prepare($quary);

        $stmt->bindParam(':ism', $name); // $name strory(ichidagi $name)
        $stmt->bindValue(':kelgan', $kelgan_vaqt->format("Y-m-d H:i"));
        $stmt->bindValue(':ketgan', $ketgan_vaqt->format("Y-m-d H:i"));
        $stmt->bindParam(':qarzi', $total);
        $stmt->execute();
        header("Location: work_of_tracker.php");
        exit();
    }



    public function getWordDayList()
    {
        $SelectQuery = "SELECT * FROM work_times ORDER BY kelgan_vaqt DESC";
        $stmt = $this->pdo->query($SelectQuery); //pdo tepadagi propertiy
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function calculateDebtTimeForEachUser()
    {
        $SelectQuery2 = "SELECT ism, SUM(required_of) as debt FROM work_times GROUP BY ism";
        $stmt = $this->pdo->query($SelectQuery2); //pdo tepadagi propertiy
        return $stmt->fetchAll();
    }


    public function markAsDone(int $id)
    {
        $quary = "UPDATE work_times SET required_of = 0 WHERE id = :id";
        $stmt = $this->pdo->prepare($quary);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: work_of_tracker.php");
    }


    public function getWorkDayListWithPagination(int $offset)
    {
        $offset = $offset ? ($offset * 10)-10 : 0;
        $query = "SELECT * FROM work_times ORDER BY kelgan_vaqt DESC LIMIT 10 OFFSET " . $offset*10;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRecords()
    {
        $query = "SELECT COUNT(id) as pageCount FROM work_times;";
        $stmt = $this->pdo->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function  calculatePageCount()
    {
        $total = $this->getTotalRecords()['pageCount'];
        return ceil($total / 10);
    }
}
