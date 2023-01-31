<?php



class CreateJSON
{

    public $users = [];
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

        $db = $this->connect();
        $statement = $db->prepare('SELECT * FROM transition');

        $statement->execute();
        $data = $statement->fetchAll();

        return $data;
    }

    public function getUsers(){
        $db = $this->connect();
        $statement = $db->prepare('SELECT DISTINCT Utilisateur FROM transition');
        $statement->execute();
        $data = $statement->fetchAll();

        return $data;
    }

    public function setUserList(){
        $db = $this->connect();
        $statement = $db->prepare('SELECT DISTINCT Utilisateur FROM transition');
        $statement->execute();
        $data = $statement->fetchAll();

        foreach ($data as $user){
            $u = new User();
            $u->name = $user['Utilisateur'];
            array_push($this->users,$u);
        }
    }

    public function getElements(){
        $db = $this->connect();
        $statement = $db->prepare('SELECT Titre, Utilisateur, WEEK(Date) AS week FROM transition');
        $statement->execute();
        $data = $statement->fetchAll();

        foreach ($data as $element){
            $elem = new Element();
            $elem->week = $element['week'];
            $elem->title = $element['Titre'];
            foreach ($this->users as $user){
                if($element['Utilisateur']==$user->name){
                    array_push($user->elements,$elem);
                }
            }
        }

    }

    public function minDate(){
        $db = $this->connect();
        $statement = $db->prepare('SELECT min(Date) FROM transition');
        $statement->execute();
        $dates = $statement->fetch();
        foreach ($dates as $date){
            echo $date;
        }

    }

    public function encodeJSON(){
        $this->setUserList();
        $this->getElements();

        $json = json_encode($this->users);
        file_put_contents('model.json', $json);

    }
}

class User{
    public $name;
    public $elements = [];

    public function toArray(){

    }
}

class Element{
    public $week;
    public $title;
}
?>