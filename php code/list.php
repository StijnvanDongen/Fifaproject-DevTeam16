<?php
require "config2.php";
require "header.php";

$sql = "SELECT * FROM teams";
$query = $db->query($sql);
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>hier onder zie je een lijst met alle teams</h1>";
echo "<ul>";

foreach ($teams as $team){

    $name = $team['teamName'];

    echo "<li><div><a href='detail.php?id={$team['id']}'><div>{$team['teamName']}</a></div></li>";

}
echo "
    </ul>
    <div class=\"wedstrijdschema\">
    <form action=\"controller.php\" method=\"post\">
        <input type=\"hidden\" name=\"type\" value=\"makeWedstrijdschema\">
        <input class=\"button\" type=\"submit\" value=\"Maak WedstrijdSchema\">
    </form> 
    <a class=\"button\" href=\"bracket.php\">WedstrijdSchema Bekijken</a> <br>   
    </div>     
";


require "footer.php";
