<?php
require "config2.php";
require "header.php";

$sql = "SELECT * FROM teams";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
if (!empty($_GET) && $_GET["msg"] != "") {
    $message = $_GET["msg"];
    echo "<script type='text/javascript'>alert('$message');</script>";
}
echo "<h2>hier onder zie je een lijst met alle teams</h2>";
echo "<ul class=\"list\">";

foreach ($teams as $team) {

    $name = $team['teamName'];

    echo "<li><div><a href='detail.php?id={$team['id']}'><div>{$team['teamName']}</a></div></li>";

}
echo "
    </ul>
    <div class=\"wedstrijdschema\">
        <form action=\"controller.php\" method=\"post\">
            <input type=\"hidden\" name=\"type\" value=\"makeWedstrijdschema\">
            
            <div class='wedstrijd-input'>
            <div class='tijd-input'>
                <label for=\"tijd\">Wedstrijd Tijd: </label>
                <input placeholder='00' type=\"number\" name=\"tijd\" id=\"tijd\" required>
            </div>
            
            <div class='tijd-input'>
                <label for=\"rusttijdens\">Rust Tijd: </label>
                <input placeholder='00' type=\"number\" name=\"rusttijdens\" id=\"rusttijdens\" required>
            </div>
            
            <div class='tijd-input'>
                <label for=\"rustna\">Pauze tussen Wedstrijden: </label>
                <input placeholder='00' type=\"number\" name=\"rustna\" id=\"rustna\" required>
            </div>
            </div>
            
            <div class='tijd-input2'>
                <label for=\"start\">Start Tijd: </label>
                <div class='input-naastelkaar'>
                    <input placeholder='00' type=\"number\" name=\"startH\" id=\"startH\" required>
                    <label>:</label>
                    <input placeholder='00' type=\"number\" name=\"startM\" id=\"startM\" required>
                </div>
            </div>
            
            <div class='tijd-input'>
                <label for=\"veld\">Aantal Velden: </label>
                <input placeholder='00' type=\"number\" name=\"veld\" id=\"veld\" required>
            </div>
            
            <div class='tijd-input'>
                <label for=\"poules\">Aantal Poules: </label>
                <input placeholder='00' type=\"number\" name=\"poules\" id=\"poules\" required>
            </div>
            
            <input class=\"button\" type=\"submit\" value=\"Maak WedstrijdSchema\">
            <a class=\"button\" href=\"bracket.php\">WedstrijdSchema Bekijken</a>  
        </form> 
    </div>     
";


require "footer.php";
