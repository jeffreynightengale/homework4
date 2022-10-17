<?php require_once("header.php"); ?>
<table class="table table-striped">
  <thead>
    <tr>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Supervisor (supervisor_name) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['sName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Supervisor added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Supervisor set supervisor_name=? where supervisor_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['sName'], $_POST['sid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Supervisor edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Supervisor where supervisor_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['sid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Supervisor deleted.</div>';
      break;
  }
}
?>
    
      <h1>Supervisors</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Supervisor ID</th>
            <th>Supervisor Name</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
<?php
$sql = "SELECT supervisor_id, supervisor_name from Supervisor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["supervisor_id"]?></td>
            <td><?=$row["supervisor_name"]?></td>
            <td>
            <form method="post" action="supervisorfile.php">
             <input type="hidden" name="id" value="<?=$row["supervisor_id"]?>" />
             <input type="submit" value="Supervisor's Managers" />
           </form>
           </td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editSupervisor<?=$row["supervisor_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editSupervisor<?=$row["supervisor_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSupervisor<?=$row["supervisor_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editSupervisor<?=$row["supervisor_id"]?>Label">Edit Supervisor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editSupervisor<?=$row["supervisor_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editSupervisor<?=$row["supervisor_id"]?>Name" aria-describedby="editSupervisor<?=$row["supervisor_id"]?>Help" name="sName" value="<?=$row['supervisor_name']?>">
                          <div id="editSupervisor<?=$row["supervisor_id"]?>Help" class="form-text">Enter the Supervisor's name.</div>
                        </div>
                        <input type="hidden" name="sid" value="<?=$row['supervisor_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="sid" value="<?=$row["supervisor_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
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
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupervisor">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addSupervisor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSupervisorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addSupervisorLabel">Add Supervisor</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="supervisorName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="supervisorName" aria-describedby="nameHelp" name="sName">
                  <div id="nameHelp" class="form-text">Enter the supervisor's name.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
