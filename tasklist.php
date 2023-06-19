<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="habitica.css" rel="stylesheet">
    <style>
      body {
        background-color: white;
        color: black;
      }
    </style>

    <title>Task List | Habitica</title>
</head>
<body>
<?php session_start();
require_once("connect.php");?>

<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="img/logo-removebg-preview.png" alt="Habitica" width="220" height="75"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="habitica-home.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Lists
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="tasklist.php">Tasks</a></li>
            <li><a class="dropdown-item" href="tasklist.php#reminderslist">Reminders</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://habitica.com/static/community-guidelines">Community</a>
        </li>
      </ul>
    <button type="button" class="btn" id="log-out">Log Out</button>
    </div>
  </div>
</nav>

<div style="margin: 50px;">
<h1 id="taskslist" style="margin-bottom: 20px;">Tasks</h1>
<table class="table">
  <tr>
    <th>Title</th>
    <th>Due</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
    $sql = "SELECT task_id, task_name, due, task_status FROM tasks ORDER BY task_status ASC, due ASC";
    $result = $con->query($sql);

    if ($result->num_rows > 0){
      while ($row = $result-> fetch_assoc()){
        $taskId = $row["task_id"];
        $taskName = $row["task_name"];
        $dueDate = $row["due"];
        $taskStatus = $row["task_status"];

        echo "<tr>
        <td>".$row["task_name"]."</td>
        <td>".$row["due"]."</td>
        <td>".$row["task_status"]."</td>
        <td>
        <a class='btn btn-danger btn-sm' href='deleteTask.php?task_name=".$taskName."'>Delete</a>
        </td>
        </tr>";
      }
      echo "</table>";
    } else {
      echo "0 result";
    }

  ?>
</table>


<h1 style="margin-top: 50px; margin-bottom: 20px;" id="reminderslist">Reminders</h1>
<table class="table">
  <tr>
    <th>Title</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Time</th>
    <th>Action</th>
  </tr>
  <?php
    $sqlReminder = "SELECT reminder_name, start_date, end_date, start_time FROM reminders ORDER BY start_date ASC";
    $result = $con->query($sqlReminder);

    if ($result->num_rows > 0){
      while ($row = $result-> fetch_assoc()){
        echo "<tr>
        <td>".$row["reminder_name"]."</td>
        <td>".$row["start_date"]."</td>
        <td>".$row["end_date"]."</td>
        <td>".$row["start_time"]."</td>
        <td>
        <a class='btn btn-danger btn-sm' href='deleteRem.php?reminder_name=".$row["reminder_name"]."'>Delete</a>
        </td>
        </tr>";
      }
      echo "</table>";
    } else {
      echo "0 result";
    }
  ?>
</table>
</div>

<div class="modal fade" id="exampleModal-todo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-add-todo">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD TODO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="addtask-db.php" method="post">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" class="form-control" name="todo-title">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <input type="text" class="form-control" name="todo-desc">
        </div>
        <div class="mb-3">
          <label class="form-label">Due date</label>
          <input type="datetime-local" class="form-control" name="todo-due">
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" name="status">
            <option>Incompleted</option>
            <option>In Progress</option>
            <option>Completed</option>
          </select>
        </div>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("log-out").addEventListener("click", function() {
  window.location.href = "logout.php";
  });
</script>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h4>About Our Website</h4>
        <p>Habitica is a free online productivity and habit-building platform that turns your real-life tasks and goals into an enjoyable game. It combines elements of a task manager, habit tracker, and role-playing game to help you stay motivated and develop positive habits.
          With Habitica, you can create a customized avatar, set up your to-do list, daily habits, and recurring tasks. As you complete your tasks and build positive habits, you earn experience points, collect rewards, and level up your character.
          Habitica also offers a social aspect, allowing you to join or create groups, participate in challenges, and engage in friendly competition with friends and other Habitica users. You can collaborate on tasks, support each other's progress, and celebrate achievements together.</p>
      </div>
      <div class="col-md-3">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="https://habitica.wordpress.com/">Blog</a></li>
          <li><a href="https://habitica.fandom.com/wiki/Habitica_Wiki">Wiki</a></li>
          <li><a href="https://habitica.fandom.com/wiki/Whats_New_2023">News</a></li>
          <li><a href="https://habitica.com/static/faq">FAQ</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h4>Contact Us</h4>
        <p>Report Account Problems :  <a href="#">admin@habitica.com</a></p>
        <p>Report a Bug :  <a href="#">admin@habitica.com</a></p>
        <p>Subscription and Payment Issues :  <a href="#">admin@habitica.com</a></p>
        <p>General Questions about the Site :  <a href="#">Habitica Help Guild</a></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <p class="text-center">&copy; 2023 Habitica. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>

