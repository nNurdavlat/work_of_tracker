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
        header("Location: class_work.php");
        exit();
    }



    public function getWordDayList()
    {
        $SelectQuery = "SELECT * FROM work_times";
        $stmt = $this->pdo->query($SelectQuery); //pdo tepadagi propertiy
        return $stmt->fetchAll();
    }
}

?>


<!-- public function required(DateTime $kelgan_vaqt, DateTime $ketgan_vaqt)
    {
        //Orasidagi vaqt hisoblash uchun diff methodi yordamga keladi
        $diff = $kelgan_vaqt->diff($ketgan_vaqt);
        $hour = $diff->h;
        $minute = $diff->i;

        $total = ((self::IshlashKerak * 3600) - (($hour * 3600) + ($minute * 60)));
        return $total;
    } -->