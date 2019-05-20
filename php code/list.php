<?php
require "config2.php";
require "header.php";

$sql = "SELECT * FROM teams";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>hier onder zie je een lijst met alle teams</h2>";
echo "<ul class=\"list\">";

foreach ($teams as $team){

    $name = $team['teamName'];

    echo "<li><div><a href='detail.php?id={$team['id']}'><div>{$team['teamName']}</a></div></li>";

}
echo "
    </ul>
    <div class=\"wedstrijdschema\">
        <form action=\"controller.php\" method=\"post\">
            <input type=\"hidden\" name=\"type\" value=\"makeWedstrijdschema\">
            
            <div class='tijd-input'>
                <label for=\"tijd\">Wedstrijd Tijd: </label>
                <input type=\"number\" name=\"tijd\" id=\"tijd\">
            </div>
            
            <div class='tijd-input'>
                <label for=\"rusttijdens\">Rust Tijd: </label>
                <input type=\"number\" name=\"rusttijdens\" id=\"rusttijdens\">
            </div>
            
            <div class='tijd-input'>
                <label for=\"rustna\">Pauze tussen Wedstrijden: </label>
                <input type=\"number\" name=\"rustna\" id=\"rustna\">
            </div>
            
            <div class='tijd-input'>
                <label for=\"start\">Start Tijd: </label>
                <input type=\"number\" name=\"startH\" id=\"startH\">
                <input type=\"number\" name=\"startM\" id=\"startM\">
            </div>
            
            <input class=\"button\" type=\"submit\" value=\"Maak WedstrijdSchema\">
        </form> 
    </div>     
    <a class=\"button\" href=\"bracket.php\">WedstrijdSchema Bekijken</a> <br>   
";


require "footer.php";
