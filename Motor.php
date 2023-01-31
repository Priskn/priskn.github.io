<?php

class Motor
{

    public $quotas = [];
    public $scores = [];
    public function browseJSON(){
        $file = 'model.json';
        $obj = json_decode(file_get_contents($file));
        return $obj;
    }


    public function calculateQuotas($user){
        $obj = $this->browseJSON();
        foreach ($obj as $value){
            if($value->name==$user){
                foreach ($value->elements as $element){
                    $isfound = false;
                    foreach ($this->quotas as $quota){
                        if($quota->date == $element->week){
                            $isfound = true;
                            switch ($element->title){
                                case  "Connexion":
                                    $quota->nbConnect++;
                                    break;
                                case  "Poster un nouveau message":
                                    $quota->nbMsgSent++;
                                    break;
                                case  "Citer un message":
                                    $quota->nbMsgQuoted++;
                                    break;
                                case  "Répondre à un message":
                                    $quota->nbAnswers++;
                                    break;
                                case  "Upload un ficher avec le message":
                                    $quota->nbUploads++;
                                    break;

                            }
                        }
                    }
                    if (!$isfound){
                        $quota = new Quota($element->week);
                        switch ($element->title){
                            case  "Connexion":
                                $quota->nbConnect++;
                                break;
                            case  "Poster un nouveau message":
                                $quota->nbMsgSent++;
                                break;
                            case  "Citer un message":
                                $quota->nbMsgQuoted++;
                                break;
                            case  "Répondre à un message":
                                $quota->nbAnswers++;
                                break;
                            case  "Upload un ficher avec le message":
                                $quota->nbUploads++;
                                break;

                        }
                        array_push($this->quotas,$quota);
                    }
                }
            }
        }
        return $this->quotas;
    }

    public function calculateScores($user){
        $q = $this->calculateQuotas($user);
        foreach ($q as $quo){
            array_push($this->scores,new Score($quo));
        }
        $usr = new Usr();
        $usr->name = $user;
        $usr->scores = $this->scores;
        $json = json_encode($usr);
        file_put_contents('scores.json', $json);

    }

    public function quotaJSON($user,$date){
        $q = $this->calculateQuotas($user);
        foreach ($q as $quota){
            if ($quota->date = $date){
                $json = json_encode($quota);
                file_put_contents('quota.json',$json);
            }
        }
    }


}

class Quota{
    public $date;
    public $nbConnect;
    public $nbMsgSent;
    public $nbMsgQuoted;
    public $nbAnswers;
    public $nbUploads;

    function __construct($week){

        $this->date = $week;
        $this->nbConnect = 0;
        $this->nbMsgSent = 0;
        $this->nbMsgQuoted = 0;
        $this->nbAnswers = 0;
        $this->nbUploads = 0;
    }

}

class Usr{
    public $name;
    public $scores;
}

class Score{
    function __construct($quota){
        $this->date = $quota->date;
        $this->score = 0;
        $this->score += $quota->nbConnect;
        $this->score += 3*$quota->nbMsgSent;
        $this->score += 2*$quota->nbMsgQuoted;
        $this->score += 3*$quota->nbAnswers;
        $this->score += 5*$quota->nbUploads;

    }
    public $date;
    public $score;
}

?>