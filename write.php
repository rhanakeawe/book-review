<?php

## Does nothing right now

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ ."/database.php";

    # Gets user from database
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    
    $sqlbooks = "SELECT * FROM `books`";
    $all_books = $mysqli->query($sqlbooks);
    
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
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
                    <li class="nav-item">
                        <a class="nav-link" href="./reviews.php">Reviews</a>
                    </li>
                    <?php if (isset($user)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./write.php">Write</a>
                    </li>
                <?php endif; ?>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link" href="./profile.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                              <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                              <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                            </svg> <?= htmlspecialchars($user["name"]) ?>
                        </a>
                    </li>
                    <?php if ($user["is_admin"]) : ?>
                      <li class="nav-item">
                        <a class="nav-link" href="./admin.php"> Admin </a>
                      </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php"> Log Out </a>
                    </li>
                </ul>
            </div>
          </div>
        </nav>
        <main>
            <div class="container">
                <form action="process-review.php" method="post" id="writereview" novalidate> <!--novalidate because it is handles elsewhere-->
                    <div class="p-2">
                        <label class="form-label" for="r_book_id">Book</label>
                        <select class="form-select" name="r_book_id" id="r_book_id">
                            <option selected>Select</option>
                            <?php while ($books = mysqli_fetch_array($all_books,MYSQLI_ASSOC)):;?>
                                <option value="<?php echo $books["book_id"];?>">
                                    <?php echo $books["title"];?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="p-2">
                        <label class="form-label" for="rating">Rating</label>
                        <input type="range" class="form-range" min="0" max="10" name = "rating" id="rating" onInput="$('#rangeval').html($(this).val())">
                        <span id="rangeval">5<!-- Default value --></span>

                    </div>
                    <div class="p-2">
                        <label class="form-label" for="Review">Review</label>
                        <textarea class="form-control" placeholder="Write a review" id="review_text" name="review_text" style="height: 200px"></textarea>
                    </div>
                    <button class="btn btn-secondary p-2">Write Review</button>
                </form>
            </div>
        </main>
    </body>
</html>