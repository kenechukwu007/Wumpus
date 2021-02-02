<!DOCTYPE html>
<html>

<head>
    <title>Hunt The Wumpus</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="wumpus.css">
</head>

<body>
    <div id="container">
        <h1>Hunt the Wumpus!</h1>
        <table>
            <?php
            for ($r=0; $r<5;$r++) {
                echo "<tr>";
                for ($c=0; $c<5; $c++) {
                    echo "<td><a href='result.php?row=$r&column=$c'></a></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>