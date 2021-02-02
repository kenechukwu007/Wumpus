<?php
// Ohia William Kenechukwu, 000791775, I hereby certify that this is my own work and that it wasn't copied from anyother source.

/**
 * Connect to the database
 */
try{
    $dbh= new PDO("mysql:host=localhost;dbname=000791775","000791775","19980312");

} catch(Exception$e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}



/**
 * filter input
 */
$row = filter_input(INPUT_GET, "row", FILTER_VALIDATE_INT);
$column = filter_input(INPUT_GET, "column", FILTER_VALIDATE_INT);

/**
 * Check if a wumpus exists at a position of row and column
 */


$command = "SELECT * FROM wumpuses WHERE r=? and c = ?";
$stmt = $dbh->prepare($command);

$wumpus = null;

 if ($row==0 and $column==0){
  $wumpus=false;
}else{
$wumpus = true;
}
if ($row==2 and $column==2){
  $wumpus=true;
}else{
$wumpus = false;
}

?>

!DOCTYPE html>
<html>

<head>

  <title>Result</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="wumpus.css">

</head>

<body>
  
  <h2><?php echo ($wumpus ? "YOU WON!" : "YOU LOST!"); ?></h2>

  <div id="container">
    <img src="<?php echo ($wumpus ? "img/win.jpg" : "img/lose.png") ?>">







    <form id="form" action="save.php" method="post">

      <h1>Player Profile</h1>
      <label for="email_address">Email Address: </label>
      <input id="email_address" type="email" value="abc@example.com" required />
      <br>
      <br>
      <input id="wumpus" name="wumpus" value=<?= $wumpus ? 'win' : 'lose' ?> />

      <input type="submit" value="SUBMIT" />
    </form>
  </div>
</body>

</html>