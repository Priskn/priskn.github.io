<?php



class CreateJSON
{


    private function connect(){
        try{
            $db = new PDO('mysql:host=localhost;dbname=testt;charset=utf8','root','root');
        }

        catch(Exception $e)
        {
            die('Erreur : '. $e->getMessage());
        }
        return $db;
    }

    public function parseDB(){

        $db = this->connect();
        $statement = $db->prepare('SELECT * FROM transition');

        $statement->execute();
        $data = $statement->fetchAll();

        return $data;
    }

    public function minDate(){
        $db = this->connect();
        $statement = $db->prepare('SELECT min("Date") FROM transition');
        $statement->execute();
        $date = $statement->fetch();
        echo $date;

    }

    public function createArray(){
        $data = $this->parseDB();

        foreach($data as $action){
        }
    }
}
?>