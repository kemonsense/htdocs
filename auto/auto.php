<?php
// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  )
{
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) )
{
    header('Location: index.php');
    return;
}

require_once "pdo.php";

if ( strlen($_POST['make'])!==0 && is_numeric($_POST['year'])
     && is_numeric($_POST['mileage'])) {
    $sql = "INSERT INTO autos (make, year, mileage)
              VALUES (:make, :year, :mileage)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage']));
    echo "Record inserted";
}
else if (strlen($_POST['make'])<1)
{
    echo "Make is required";
}

else {
   echo "Mileage and year must be numeric";
}

$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
</head>
<body>
  <?php
      if ( isset($_REQUEST['name']) )
      {
          echo "<p>Welcome: ";
          echo htmlentities($_REQUEST['name']);
          echo "</p>\n";
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
<p>Add A New Car</p>
<form method="post">
<p>Make:
<input type="text" name="make" size="40"></p>
<p>Year:
<input type="text" name="year"></p>
<p>Mileage:
<input type="text" name="mileage"></p>
<p><input type="submit" value="Add"/>
  <input class="btn" type="submit" name="logout" value="Logout">
</p>
</form>
</body>
