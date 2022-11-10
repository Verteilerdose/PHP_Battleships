<?php

// 1. readline, choose a player name:
// 2. place 2 Ships with the size of (x=1, y=1)
// 3. "AI placed their Ships 8maybe echo ""AI playced their ships"
// 4. game start
// 5. "Place your bomb" x= , y= ;
//  --> if hit echo: "HIT, you destroyed one ship with the coordinates: x...,y..."
//  --> if noHit echo: "No HIT"
// 6. AI places Bomb [ rand(min, max) ] , same echo's

//RULES/ Guidelines
// - das Spielfeld ist 5 x 5 Felder groß
// - je Spieler sind 3 Schiffe verfügbar
// - die Schiffe des Computers werden nur auf der Karte angezeigt, wenn diese zerstört wurden
//  *  zerstörtes Computerschiff
//  X  zerstörtes Spielerschiff
//  ^  Spielerschiff
//  ~  Wasser


//Player1 mit custom username
class Player
{
}

//Computer als AI Spieler
class Computer
{
}

//Schiffe (Positionen)
class Ships
{
}


//Spielbrett [~][*][^]
class Spielbrett
{
    public array $map = [
        ["~", "~", "~", "~", "~", "\n"],
        ["~", "~", "~", "~", "~", "\n"],
        ["~", "~", "~", "~", "~", "\n"],
        ["~", "~", "~", "~", "~", "\n"],
        ["~", "~", "~", "~", "~", "\n"],
    ];

    function zeigeDasSpielbrettAn(): void
    {
        for ($y = 0; $y < 5; $y++) {
            for ($x = 0; $x < 5; $x++) {
                echo ' ' . $this->map[$y][$x] . ' ';
            }
            echo "\n";
        }
    }
}

$spielbrett = new Spielbrett();


function playerName(): void
{
    while (true) {
        //Intro
        $welcoming = readline("welcome to BattleShips. Those are the Symbols used in this game \n ⛵  = your own Ship \n 💥 = your Attacks \n 💢 = Enemy Attacks \n hit ENTER");
        $intro = readline("please enter your player name [e=Exit] :  ");
        if ($intro === 'e') {
            exit(0);
        }
        echo "Hey, welcome " . $intro, "\n";
        break;
    }
}

function attacks(): void
{
    $spielbrett = new Spielbrett();
    $spielbrett->zeigeDasSpielbrettAn();
    //SCHIFFE PLATZIEREN
    echo "Dein Spielfeld ist 5x5. Bitte setze deine 2 Schiffe nun";
    $shipY = ((int)readline("\nGib die Y-Koordinate für das erste Schiff an(1-5): ")) - 1;

    $shipX = ((int)readline("\nGib die X-Koordinate für das erste Schiff an(1-5): ")) - 1;

    $spielbrett->map[$shipY][$shipX] = "⛵";

    $shipY2 = ((int)readline("\nGib die Y-Koordinate für das zweite Schiff an(1-5): ")) - 1;

    $shipX2 = ((int)readline("\nGib die X-Koordinate für das zweite Schiff an(1-5): ")) - 1;


    $spielbrett->map[$shipY2][$shipX2] = "⛵";
    $spielbrett->zeigeDasSpielbrettAn();
    echo "Deine Schiffe:";

    echo "Computer hat Schiffe gesetzt\n";

    $npcShips = [];

    $npcShipsx1 = random_int(0, 4);
    $npcShipsy1 = random_int(0, 4);
    $npsShipsx2 = random_int(0, 4);
    $npcShipsy2 = random_int(0, 4);
    $spielbrett->map[$npcShipsx1][$npcShipsy1] = "^";
    $spielbrett->map[$npsShipsx2][$npcShipsy2] = "^";
    echo $npcShipsx1, $npcShipsy1;
    echo $npsShipsx2, $npcShipsy2;

    while (true) {
        $attackX1 = ((int)readline("\nAngriff auf X Koordinate!(1-5): ")) - 1;
        $attackY2 = ((int)readline("\nAngriff auf Y Koordinate!(1-5): ")) - 1;
        $spielbrett->zeigeDasSpielbrettAn();
        for ($i = 0; $i < 2; $i++) {
            if (!isset($npcShips[$i]))
                continue;
            if ($npcShips[$i]['x'] === $attackX1 && $npcShips[$i]['y'] === $attackY2) {
                $spielbrett->map[$attackX1][$attackY2] = '*';
                unset($npcShips[$i]);
                echo "wir haben ein Schiff getroffen\n";
            }
        }
    }
        // NPC Angriff
        $npc_attackx = random_int(0, 4);
        $npc_attacky = random_int(0, 4);

        for ($i = 0; $i <= 5; $i++) {
            if (!isset($map[$i])) {
                continue;
            }
            if ($npc_attackx[$i]['x'] === $shipX && $npc_attacky[$i]['y'] === $shipY) {
                $spielbrett->map[$attackX1][$attackY2] = '-';
                unset($npcShips[$i]);
                echo "Gegner hat eines deiner Schiffe getroffen\n";
            } else echo "Gegner hat verfehlt";
            $spielbrett->zeigeDasSpielbrettAn();

            if (count($npcShips) === 0) {
                clearScreen();
                $spielbrett->zeigeDasSpielbrettAn();
                echo "\nDu hast gewonnen\n";
                exit(0);
            }
        }
    }

playerName();
attacks();




function clearScreen(): void
{
    system('clear');
}
