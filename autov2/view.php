<?php
session_start();
if ( !isset($_SESSION['who']) ) {
  die('Not logged in');
}

require_once "pdo.php";
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<head>
  <title>SABBIR HOSEN EMON</title>
</head>
<body>
  <h1>Tracking Autos for <?php echo $_SESSION['who']; ?></h1>
    <?php
    if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
    }
    ?>

<table border="1">
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['make']);
    echo("</td><td>");
    echo($row['year']);
    echo("</td><td>");
    echo($row['mileage']);
    echo("</td></tr>\n");
}
?>
</table>
<p>
<a href="add.php">Add New</a> |
<a href="logout.php">Logout</a>
</p>
</body>
