<?php require_once("header.php"); ?>
<h1>Edit Employee</h1>
<div class="alert alert-success" role="alert">
  Your employee has been edited in the database!
</div>
<?php
$servername = "localhost:3306";
$username = "jeffreyn_user1";
$password = "0w_zeP}]OVy0";
$dbname = "jeffreyn_homework3";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$eName = $_POST['eName'];
$mID = $_POST['mID'];
$mName = $_POST['mName'];
$sql = "UPDATE Employee set employee_name=?, manager_ID=?, manager_name=? where employee_ID=?";
    $stmt = $conn->prepare($sql);
      $stmt->bind_param("sisi", $eName, $mID, $mName, $_POST['eid']);
    $stmt->execute();
?>
<a href="employees.php" class="btn btn-primary">Go back</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
