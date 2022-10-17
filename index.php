<?php require_once("header.php"); ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Customer ID</th>
      <th>Customer Name</th>
      <th>Employee ID</th>
      <th>Product Name</th>
      <th>Product Cost</th>
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
      $sqlAdd = "insert into Customer (customer_name, employee_id, product_name, product_cost) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sisi", $_POST['cName'], $_POST['eid'], $_POST['pName'], $_POST['pCost']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Customer added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Customer set customer_name=?, employee_id=?, product_name=?, product_cost=? where customer_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sisii", $_POST['cName'], $_POST['eid'], $_POST['pName'], $_POST['pCost'], $_POST['cid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Customer edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Customer where customer_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['cid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Customer deleted.</div>';
      break;
  }
}
?>         
<?php
$sql = "SELECT customer_id, customer_name, employee_id, product_name, product_cost FROM Customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["customer_id"]?></td>
            <td><?=$row["customer_name"]?></td>
            <td><?=$row["employee_id"]?></td>
            <td><?=$row["product_name"]?></td>
            <td><?=$row["product_cost"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCustomer<?=$row["customer_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editCustomer<?=$row["customer_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCustomer<?=$row["customer_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCustomer<?=$row["customer_id"]?>Label">Edit Customer</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCustomer<?=$row["Customer_id"]?>Name" class="form-label">Customer Name</label>
                          <input type="text" class="form-control" id="editCustomer<?=$row["customer_id"]?>Name" aria-describedby="editCustomer<?=$row["customer_id"]?>Help" name="cName" value="<?=$row['customer_name']?>">
                          <div id="editCustomer<?=$row["customer_id"]?>Help" class="form-text">Enter the Customer's name.</div>
                          <label for="SupervisorID" class="form-label">Supervisor ID</label>
                          <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="sid" value="<?=$row['supervisor_id']?>">
                          <div id="nameHelp" class="form-text">Enter the Supervisor's ID</div>
                          <label for="supervisorName" class="form-label">Supervisor Name</label>
                          <input type="text" class="form-control" id="supervisorName" aria-describedby="nameHelp" name="sName" value="<?=$row['supervisor_name']?>">
                          <div id="nameHelp" class="form-text">Enter the Supervisor's name</div>
                        </div>
                        <input type="hidden" name="mid" value="<?=$row['manager_id']?>">
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
                <input type="hidden" name="mid" value="<?=$row["manager_id"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addManager">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addManager" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addManagerLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addManagerLabel">Add Manager</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="managerName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="mName" aria-describedby="nameHelp" name="mName">
                  <div id="nameHelp" class="form-text">Enter the Manager's name.</div>
                  <label for="supervisorID" class="form-label">Supervisor ID</label>
                  <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="sid">
                  <div id="nameHelp" class="form-text">Enter the Supervisor's ID.</div>
                  <label for="supervisorName" class="form-label">Supervisor Name</label>
                  <input type="text" class="form-control" id="sName" aria-describedby="nameHelp" name="sName">
                  <div id="nameHelp" class="form-text">Enter the Supervisor's name.</div>
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
