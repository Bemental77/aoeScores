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

        $uniqueTechnologies = explode(",", $uniqueTechs);

        $civTeams[$civName] = $team;
        $civSpecialUnits[$civName] = $specialUnit;
        $civTechs[$civName] = $uniqueTechnologies;
        $civScores[$civName] = $score;

        if (!isset($teamScores[$team])) {
            $teamScores[$team] = $score;
        } else {
            $teamScores[$team] += $score;
        }

        if ($score > $highScore){
            $highScore = $score;
            $highScoreCiv = $civName;
        }

    }

}

foreach ($civTeams as $civ => $civTeam){
    $civLowerCase = strtolower($civ);
    ?>
    <section class="civ">
        <aside class="shadowEffect">
            <img id="civPic" src="images/Wonder<?= "$civLowerCase" ?>.png" alt="<?= "$civLowerCase" ?> Wonder<?= "$civLowerCase" ?>">
        </aside>

        <div class="civInfo">
            <p class="civName"><?= "$civ" ?></p>
            <ul id="mainUL">
                <li>Unique Unit: <?= "$civSpecialUnits[$civ]" ?></li>
                <li>Unique Technologies:
                    <ul>
                        <li><?= $civTechs[$civ][0] ?></li>
                        <li><?= $civTechs[$civ][1] ?></li>
                    </ul>
                </li>
                <li>Game Score: <?= "$civScores[$civ]" ?></li> </ul>
        </div>
    </section>
    <?php
}

    ?><div class="scores">
    <?php
    foreach ($teamScores as $team => $teamScore){
    ?>
    <h3>Team #<?= "$team" ?> had a cumulative score of <?= "$teamScore\n" ?></h3><?php
    }
    ?><h3>The <?= "$highScoreCiv" ?> had the high score of <?= "$highScore" ?></h3>
    </div>
</body>
</html>