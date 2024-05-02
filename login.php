<?php

## The login page

    $is_invalid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        # Connects to database
        $mysqli = require __DIR__ ."/database.php";
        # Queries database for email
        $sql = sprintf("SELECT * FROM user
                        WHERE email = '%s'",
                        $mysqli->real_escape_string($_POST["email"]));
        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();

        # Checks if password entered matches user password_hash
        if ($user) {
            if (password_verify($_POST["password"], $user["password_hash"])) {
                
                # Starts session as user
                session_start();
                session_regenerate_id();

                # Sets user_id for session
                $_SESSION["user_id"] = $user["id"];

                header("Location: home.php");
                exit;
            }
        }

        $is_invalid = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BookReviews</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-warning">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                  </svg>  BookReviews
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
              <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                  <a class="nav-link" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./books.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container">
            <main>
                <h1 class="fw-bold text-body-emphasis p-4">Login</h1>

                <?php if ($is_invalid) : ?>
                    <em>Invalid login</em>
                <?php endif; ?>
                
                <form method="post">
                    <div class="p-2">
                        <label class="fom-label" for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" 
                                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>
                    <div class="p-2">
                        <label class="fom-label" for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <button class="btn btn-secondary p-2">Log in</button>
                </form>
            </main>
        </div>
    </body>
</html>