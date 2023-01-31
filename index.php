<?php
include "CreateJSON.php";
include "Motor.php";
$creator = new CreateJSON();

$creator->minDate();



?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style src="style.css"></style>






<form method="post" action="#">
    <p>
        <!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
        <select name="user">

            <?php
                $users = $creator->getUsers();
                foreach ($users as $user){
                    echo "<option value=\"".$user['Utilisateur']."\">".$user['Utilisateur']."</option>";
                }
            ?>
        </select>

        <input type="submit" value="Choisir" title="user" />

    </p>
</form>
<?php
    if(isset($_POST['user'])) {
        echo $_POST['user']."<br/><br/>";
        $creator->encodeJSON();
        $motor = new Motor();
        $motor->calculateScores($_POST['user']);

    }

?>



<figure class="highcharts-figure">
    <div id='container'></div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script src="script.js"></script>

</figure>