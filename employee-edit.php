<?php require_once("header.php"); ?>
<h1>Edit Employee</h1>
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

$sql = "SELECT employee_id, employee_name, manager_id, manager_name FROM Employee where employee_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['eid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<form method="post" action="employee-edit-save.php">
  <div class="mb-3">
    <label for="employeeName" class="form-label">Name</label>
    <input type="text" class="form-control" id="employeeName" aria-describedby="nameHelp" name="eName">
    <div id="nameHelp" class="form-text">Enter the employee's name</div>
      <label for="managerID" class="form-label">Name</label>
    <input type="text" class="form-control" id="managerID" aria-describedby="nameHelp" name="mID">
    <div id="nameHelp" class="form-text">Enter the Manager's ID</div>
      <label for="managerName" class="form-label">Name</label>
    <input type="text" class="form-control" id="managerName" aria-describedby="nameHelp" name="mName">
    <div id="nameHelp" class="form-text">Enter the Manager's name</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
