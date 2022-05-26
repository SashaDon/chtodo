<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet"> 

<?php
require_once dirname(__FILE__) . "/vendor/autoload.php";

require "connect.php";
$db->database('todo');

if( $db->ping() === false ){
    echo "server connection failed! \n";
    die();
}

echo('<parasha style="display: flex;justify-content: center;height: 50%;flex-direction: column;width: 30%;">');
echo('<logo style="display: flex;justify-content: center;" href="index.php">');
echo('<img src="logo.png" alt="logo" style="width: 70px;height: 70px;padding: 1em;"> ');
echo('</logo>');
echo('<texttoadd style="display: flex;justify-content: center;width: 100%;">');
    echo('<input type="text" id="toAdd" style="width: 60%;">');
echo('</texttoadd>');
echo('<buttontoadd style="display: flex;justify-content: center;padding: 1em;">');
    echo('<button type="button" onClick="addtoch()" style="width: 30%;">Add</button>');
echo('</buttontoadd>');

$todos = $db->select(
    "
    SELECT *
    FROM Tasks
    "
    )->rows();
    
    echo("<table>");
    echo("<tr>
    <th class='booty'>Title</th>
    <th class='booty'>Status</th>
    <th class='booty'>DateAdded</th>
    </tr>");
    
    foreach ($todos as $todo) {
        echo("<tr>
        <th>{$todo['Title']}</th>
        <th><input type='checkbox' id='{$todo['Id']}' onClick='boxchecked(this.id, this.value)' value='{$todo['Status']}'" . ($todo['Status'] ? "checked" : "") . "></th>
        <th>{$todo['DateAdded']}</th>
        <th><button id='{$todo['Id']}' type='button' onClick='removetask(this.id)'>Remove</button></th>
        </tr>");
    }
    
    echo("</table>");
    echo('</parasha>');
    php?>

<script>
    function boxchecked(changeid, status) {
        statussetting = 1-status;
        window.location = "http://3.138.123.188/alter.php?box=" + changeid + "&setto=" + statussetting + "&task=alter";
    }
    
    function addtoch() {
        if (document.getElementById('toAdd').value != '') {
            window.location = "http://3.138.123.188/alter.php?task=add&toadd=" + document.getElementById('toAdd').value;
        }
    }
    
    function removetask(idtoremove) {
        window.location = "http://3.138.123.188/alter.php?task=delete&toremove=" + idtoremove;
    }
</script>

<style>
    body {
        display: flex;
        justify-content: center;
        height: 100%;
    }

    body {
        font-family: Secular One;
    }

    .booty {
        font-family: 'Assistant', sans-serif;
    }
</style>