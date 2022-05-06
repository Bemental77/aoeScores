<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AOE - Civ</title>
    <link rel="stylesheet" href="css/aoeCivs.css">
</head>
<body>
<?php
$highScore = 0;
$highScoreCiv = "";

$fp = fopen("aoeCivInfo.txt", "r");


while (!feof($fp)) {

    $civLine = rtrim(fgets($fp));

    if ($civLine != "") {

        list($civName, $team, $specialUnit, $uniqueTechs, $score) = explode(":", $civLine);

        list($uniqueTechnologies) = explode(",", $uniqueTechs);


        $civTeams[$civName] = $team;
        $civSpecialUnits[$civName] = $specialUnit;
        $civTechs[$civName] = $uniqueTechnologies;
        $civScores[$civName] = $score;

        foreach ($score as $team => $teamScores) {
            $score += $teamScores;
        }

        $highScore = max($score);
        $highScoreCiv = array_search($highScore, $civName);

        foreach ($civTeams as $civ => $civTeam){
            $civLowerCase = strtolower($civName);
            ?>
            <section class="civ">
                <aside class="shadowEffect">
                    <img src="images/Wonder<?= "$civLowerCase" ?>.png" alt="<?= "$civLowerCase" ?> Wonder<?= "$civLowerCase" ?>">
                </aside>

                <div class="civInfo">
                    <p class="civName"><?= "$civName" ?></p>
                    <ul id="mainUL">
                        <li>Unique Unit: <?= "$specialUnit" ?></li>
                        <li>Unique Technologies:
                            <ul>
                                <li><?= "$uniqueTechnologies" ?></li>
                                <li><?= "$civTechs[$civName]" ?></li>
                            </ul>
                        </li>
                        <li>Game Score: <?= "$score" ?></li> </ul>
                </div>
            </section>
            <?php
        }

    }

}
?><div class="scores">

    <?php
    foreach ($teamScores as $team){
        ?>
        <h3>Team #<?= "$team" ?> had a cumulative score of <?= "$teamScores\n" ?></h3><?php
    }
    ?><h3>The <?= "$highScoreCiv" ?> had the high score of <?= "$highScore" ?></h3>
</div>

</body>
</html>