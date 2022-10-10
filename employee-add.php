<?php require_once("header.php"); ?>
<h1>Add Employee</h1>
<form method="post" action="employee-add-save.php">
  <div class="mb-3">
    <label for="employeeName" class="form-label">Name</label>
    <input type="text" class="form-control" id="employeeName" aria-describedby="nameHelp" name="eName">
    <div id="nameHelp" class="form-text">Enter the employee's name</div>
     <label for="managerID" class="form-label">ManagerID</label>
    <input type="text" class="form-control" id="managerID" aria-describedby="nameHelp" name="mID">
    <div id="nameHelp" class="form-text">Enter the manager's ID</div>
     <label for="managerName" class="form-label">Manager Name</label>
    <input type="text" class="form-control" id="managerName" aria-describedby="nameHelp" name="mName">
    <div id="nameHelp" class="form-text">Enter the manager's name</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
