<?php
    include 'Motor.php';
    $motor = new Motor();
    $motor->quotaJSON($_GET["name"],$_GET["week"]);


?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style src="style.css"></style>

<p>
    <h1><a href="index.php">Accueil</a></h1>
</p>









<figure class="highcharts-figure">
    <div id='container'></div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script src="polar.js"></script>

</figure>
