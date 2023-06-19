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
        background-image: white;
        color: black;
      }

      .btn {
        border: none;
      }

      .btn:hover {
        background-color: #c6a9ff;
      }
    </style>
    <title>Home | Habitica</title>

</head>
<body>
<?php session_start();
require_once("connect.php");?>

<?php
  $sql = "SELECT * FROM tasks WHERE task_status != 'Completed'";
  $result = $con->query($sql);
  $numTasks = $result->num_rows;

  $sqlR = "SELECT * FROM reminders";
  $resultR = $con->query($sqlR);
  $numRems = $resultR->num_rows;
?>

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

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/car-1.png" class="d-block w-100" alt="welcome-car">
      <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to Habitica, <?php echo $_SESSION["username"]; ?>!</h5>
        <p>Stay motivated, stay focused, and embark on an epic journey of self-improvement with Habitica!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/car-2.png" class="d-block w-100" alt="welcome-car-2">
      <div class="carousel-caption d-none d-md-block">
        <h5>Thank You for Joining Habitica!</h5>
        <p>With Habitica, you can turn your tasks and goals into exciting quests, earn rewards, and level up your character as you make progress in your daily life.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card" id="card-child-left">
      <div class="card-body">
        <h5 class="card-title">You have <?php echo $numTasks; ?> upcoming tasks</h5>
        <p class="card-text">Stay organized and stay on top of your responsibilities with Habitica's task management. Keep track of your upcoming tasks and complete them one by one to level up and earn rewards.</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-todo" id="add-todo">Add Task </button>
        <a href="tasklist.php" class="btn btn-primary">Go to Tasks</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card" id="card-child-right">
      <div class="card-body">
        <h5 class="card-title">You have <?php echo $numRems; ?> reminders</h5>
        <p class="card-text">Stay on track and never miss an important event with Habitica's reminder feature. Add and manage your reminders to ensure you never forget important dates, appointments, or tasks.</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-reminder" id="add-reminder">Add Reminder </button>
        <a href="tasklist.php#reminderslist" class="btn btn-primary">Go to Reminders</a>
      </div>
    </div>
  </div>
</div>



<!-- modal add todo -->
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
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- modal add reminder -->
<div class="modal fade" id="exampleModal-reminder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-add-todo">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD REMINDER</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="addremm-db.php" method="post">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="rem-title">
          </div>
          <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="rem-startdt">
          </div>
          <div class="mb-3">
            <label class="form-label">End date</label>
            <input type="date" class="form-control" name="rem-enddt">
          </div>
          <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" class="form-control" name="rem-starttm">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

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



<script>
  document.getElementById("log-out").addEventListener("click", function() {
  window.location.href = "logout.php";
  });
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>