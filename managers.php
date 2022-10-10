<?php require_once("header.php"); ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Manager ID</th>
      <th>Manager Name</th>
      <th>Supervisor ID</th>
      <th>Supervisor Name</th>
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

$sql = "SELECT manager_id, manager_name, supervisor_id, supervisor_name FROM Manager";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
<tr>
  <td><?=$row["manager_id"]?></td>
  <td><?=$row["manager_name"]?></td>
  <td><?=$row["supervisor_id"]?></td>
  <td><?=$row["supervisor_name"]?></td>
   <td>
      <form method="post" action="managercust.php">
        <input type="hidden" name="id" value="<?=$row["manager_id"]?>" />
        <input type="submit" value="Manager Sells" />
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
