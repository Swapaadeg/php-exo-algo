<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo PHP</title>
</head>
<body>
    <h1>Exo PHP</h1>

    <h2>Exo 1</h2>
    <?php 
    for($nbr = 0; $nbr <= 25; $nbr++ ) {
    echo $nbr . "<br>";
    }
    ?>

    <h2>Exo 2</h2>
    <br>
    <?php
    $nbr = 25;
    while($nbr > 0) {
        echo $nbr . "<br>";
        $nbr--;
    }
    ?>

    <h2>Exo 3</h2>

    <?php 
    for ($nbr = 1; $nbr <= 25; $nbr++ ) {
        for ($add = 1; $add <= $nbr; $add++) {
            echo $add;
        }
        echo "<br>";
    }
    ?>

    <h2>Exo 4</h2>
    <?php
    $somme = 0;
    for($add=1 ; $add <= 30; $add++) {
        $somme += $add;
    }
    echo $somme;
    ?>

    <h2>Exo 5</h2>
    <?php
    function estPair($number) {
        if($number % 2 === 0 ){
            return "je suis pair sa mère !";
        }else 
            return "je suis peut être ton père ! mais pas pair !";
    }
    echo estPair(27)
    ?>

    <h2>Exo 6</h2>
    <?php
    function test($number) {
      if($number % 2 === 0 ){
        return $number . " ";
    }
    }
    for($number = 1; $number <= 20 ; $number ++){
        echo test($number);
    }
    ?>

    <h2>Exo 7</h2>
    <?php

    function pythagore($b, $c) {
        $a = sqrt($b*$b + $c*$c);
        return $a;
    }
    echo pythagore(2, 4);
    ?>

    <h2>Exo 8</h2>
    <?php
    $heure = 11;
    if($heure >12 && $heure <19) {
        echo $heure . " " . "c'est l'après-midi";
    }else if($heure >=19 && $heure <24) {
        echo $heure . " " . "c'est le soir";
    }else if($heure <= 12 ) {
        echo $heure . " " . "c'est le matin";
    }else if($heure>=25){
        echo $heure. " " . "error";
    }
    ?>

    <h2>Exo 9</h2>
    <?php
    echo (41 % 2 == 0) ? "Pair" : 'Impair';
    ?>

    <h2>Exo 10</h2>
    <?php
    for($nbr = 1; $nbr <= 100; $nbr++) {
        if($nbr % 3 ==0 && $nbr%5 ==0) {
            echo $nbr . " foobar ";
        }else if($nbr % 5 ==0) {
            echo $nbr . " bar ";
        }else if($nbr % 5==0){
            echo $nbr . " foo ";
        }
    }
    ?>

    <h2>Exo 11</h2>
    <?php
    $identitePersonne = [
        'nom' => 'Croft',
        'prenom' => 'Lara',
        'metier' => 'Archéologue'
    ];
    echo "<h1>" ."C'est un plaisir de vous voir ". $identitePersonne['prenom'] . " " . $identitePersonne['nom'] . " ! " . "(" . $identitePersonne['metier'] . ")" . "</h1>";
    ?>

    <h2>Exo 12</h2>
    <?php
    $fighters=['Zelda','Samus','Bowser','Peach','Lucina'] ;
    foreach($fighters as $fighter) {
        echo strlen($fighter) == 6 ? $fighter ." " : ' ';
    }

    ?>
</body>
</html>