<?php require_once("header.php"); ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Employee Name</th>
      <th>Manager ID</th>
      <th>Manager Name</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
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

$sql = "SELECT employee_id, employee_name, manager_id, manager_name FROM Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<tr>
  <td><?=$row["employee_id"]?></td>
  <td><?=$row["employee_name"]?></td>
  <td><?=$row["manager_id"]?></td>
  <td><a href="managerfile.php?id=<?=$row["manager_id"]?>"><?=$row["manager_name"]?></a></td>
  <td>
    <form method="post" action="employee-edit.php">
      <input type="hidden" name="eid" value="<?=$row["employee_id"]?>"/>
      <input type="sumbit" value="Edit" class="btn" />
    </form>
  </td>
    <td>
    <form method="post" action="employee-delete-save.php">
      <input type="hidden" name="eid" value="<?=$row["employee_id"]?>"/>
      <input type="sumbit" value="Delete" class="btn btn-primary" onclick="confirm('Are you sure?')" />
    </form>
  </td>
</tr>
  <?php
    }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
</table>
<br>
<a href="employee-add.php" class="btn btn-primary">Add Employees</a>
</br>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
