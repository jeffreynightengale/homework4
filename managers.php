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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Manager (manager_name, supervisor_ID, supervisor_name) value (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sis", $_POST['mName'], $_POST['sID'], $_POST['sName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Manager added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Manager set manager_name=?, supervisor_ID=?, supervisor_name=? where manager_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sisi", $_POST['mName'], $_POST['sid'], $_POST['sName'], $_POST['mid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Manager edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Manager where manager_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Manager deleted.</div>';
      break;
  }
}
?>         
<?php
$sql = "SELECT manager_id, manager_name, supervisor_id, supervisor_name from manager";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["manager_id"]?></td>
            <td><a href="managerfile.php?id=<?=$row["manager_id"]?>"><?=$row["manager_name"]?><?=$row["supervisor_id"]?><?=$row["supervisor_name"]?></a></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editInstructor<?=$row["instructor_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editInstructor<?=$row["instructor_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInstructor<?=$row["instructor_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editInstructor<?=$row["instructor_id"]?>Label">Edit Instructor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editInstructor<?=$row["instructor_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editInstructor<?=$row["instructor_id"]?>Name" aria-describedby="editInstructor<?=$row["instructor_id"]?>Help" name="iName" value="<?=$row['instructor_name']?>">
                          <div id="editInstructor<?=$row["instructor_id"]?>Help" class="form-text">Enter the instructor's name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['instructor_id']?>">
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
                <input type="hidden" name="iid" value="<?=$row["instructor_id"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInstructor">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addManager" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInstructorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addManagerLabel">Add Manager</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="instructorName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="instructorName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the instructor's name.</div>
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
