<?php
// Ohia William Kenechukwu, 000791775, I hereby certify that this is my own work and that it wasn't copied from anyother source.


class Player
{
    private $emailAddress;
    private $win;
    private $loss;
    private $dateLastPlayed;
   
    function _construct($emailAddress, $win, $loss,$dateLastPlayed)
    {
        $this->emailAddress = $emailAddress;
        $this->win = $win;
        $this->loss = $loss;
        $this->dateLastPlayed = $dateLastPlayed;
    }
    // will display the players information as a table column name
    function tableItem()
    {
        return "
         <td>$this->emailAddress </td> 
         <td>$this->win </td>
         <td> $this->loss</td> 
         <td>$this->dateLastPlayed </td>"
        ;
    }
}

/**
 * Connect to the database
 */
try{
    $dbh= new PDO("mysql:host=localhost;dbname=000791775","000791775","19980312");

} catch(Exception$e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

//check if the email exist in the table

function if_exist($emailAddress)
{
    global $stmt;
    $command = "SELECT * FROM players WHERE emailAddress=? LIMIT 1";
	
	
	$success = $stmt -> execute($emailAddress);

    return $stmt->rowCount()?1:0;
    
}

// filter input for the email and wumpuses
    
$emailAddress = filter_input(INPUT_POST,"emailAddress",FILTER_VALIDATE_EMAIL);
$wumpus = filter_input(INPUT_POST,"wumpus",FILTER_VALIDATE_BOOLEAN);

if($emailAddress===false||$emailAddress===NULL ||$wumpus===NULL)
    echo("Wrong value input, try again.");


if(if_exist($emailAddress))
{
    if($wumpus){$command = "UPDATE players SET wins = wins+1,loss = loss,date_last_played =? WHERE emailAddress=?";}
    else{$command = "UPDATE players SET wins = wins, loss=loss+1, date_last_played=? WHERE emailAddress=?";}

    
}
else {

$command = "INSERT INTO players(emailAddress, wins, loss, date_last_played) VALUES (?,?,?,?)";
$params = [$emailAddress,$ifWin?1:0,$ifWin?0:1,$dateLastPlayed];

}
//get PLayers Date 
$players = [];
$command = "SELECT * FROM players ORDER BY wins ";

while($row = $stmt->fetch())
{
$player = new Player($row["emailAddress"],$row["wins"],$row["loss"],$row["date_last_played"]);
array_push($players,$player);
}

?>

<!DOCTYPE html>
<html>
  <head>
  
    <title>Result</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="wumpus.css">
  </head>
  <body>
    <h2>LeaderBoard</h2>
    <div id="container">
    <table>
        
        <td>Email</td>
        <td>Wins</td>
        <td>Loss</td>
        <td>Date Last Played</td>
         <?php
            foreach($players as $player)
            {
                echo $player->tableItem();
            }
        ?>
    </table>
    <br>
    <a href="index.php">Play Again!</a>
  </div>
  </body>
</html>
