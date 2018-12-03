<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Task Editor</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/styles/taskeditor.css" rel="stylesheet">
</head>
<body class="text-center">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="
                <?php
                if (isset($_SESSION['logged_user'])) {
                    echo '/logout">Logout';
                } else {
                    echo '/login">Login';
                }
                ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/newtask">New Task</a>
            </li>
        </ul>
    </div>
</nav>
<div id="prev_container" class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col" id="username">User</th>
            <th scope="col" id="email">Email</th>
            <th scope="col">Text</th>
            <th scope="col">Img</th>
            <th scope="col" id="status">Status</th>
        </tr>
        </thead>
        <tbody>
            <tr id="prev_place"></tr>
        </tbody>
    </table>
    <button id="end_preview" onclick="stopPreview()">Hide Preview</button>
</div>
<form action="/newtask" enctype="multipart/form-data" method="post" class="form-task">
    <div class="form-group">
        <label for="taskName">Username</label>
        <input class="form-control" required id="taskName" name="Username" placeholder="Enter your Name">
        <p id="messageName"></p>
    </div>
    <div class="form-group">
        <label for="taskEmail">Email address</label>
        <input type="email" required class="form-control" id="taskEmail" name="Email" placeholder="name@example.com">
        <p id="messageEmail"></p>
    </div>
    <div class="form-group">
        <label for="taskText">Enter text of your task</label>
        <textarea class="form-control" id="taskText" required name="Text" rows="3"></textarea>
        <p id="message"></p>
    </div>
    <div class="form-group">
        <label for="taskImage">Attach picture</label>
        <p>Images should be 320x240, GIF/PNG/JPEG and less than 3 MB.<br>Otherwise file wouldn't be uploaded, images bigger than 320x240 would be cropped</p>
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
        <input type="file" class="form-control-file" name="Image" id="taskImage">
    </div>
    <div class="form-group" onclick="loadPreview(); return false">
        <button id="preview">Preview</button>
    </div>
    <div class="form-group">
    <input type="submit" name="post" value="Submit" id="post">
    </div>
</form>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="/js/task_editor.js"></script>
</html>