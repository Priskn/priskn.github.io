<?php
include CreateJSON::class;
$creator = new CreateJSON();

$creator->minDate();
try{
    $db = new PDO('mysql:host=localhost;dbname=testt;charset=utf8','root','root');
}

catch(Exception $e)
{
    die('Erreur : '. $e->getMessage());
}


?>
<form method="post" action="http://www.monsite.net/redirection_navigation.php">
    <p>
        <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
        <select name="menu_destination">
            <option value="http://www.monsite.net/accueil.html">Accueil</option>
            <option value="http://www.monsite.net/apropos.html">Qui sommes-nous ?</option>
            <option value="http://www.monsite.net/contact.html">Nous contacter</option>
            <option value="http://www.monsite.net/plan.html">Plan du site</option>
        </select>

        <input type="submit" value="Go" title="valider pour aller à la page sélectionnée" />

    </p>
</form>
