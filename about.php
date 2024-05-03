<?php

## The home page

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ ."/database.php";

    # Gets user from database
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
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
                <li class="nav-item">
                  <a class="nav-link" href="./reviews.php">Reviews</a>
                </li>
              </ul>
              <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <?php if (isset($user)) : ?>
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
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./sign_up.html">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                          </svg> Sign Up
                        </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="./login.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                          <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
                        </svg> Log In
                      </a>
                    </li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container">
          <main>
          <h1 class="fw-bold text-body-emphasis p-4">About Book Reviews</h1>
            <div class="row">
              <div class="col-md-6">
                <div class="about-section">
                  <?php 
                    // First half of about
                    echo "<p>Welcome to Book Reviews</p>";
                    echo "<p>Nestled within the virtual realms of cyberspace lies an enigmatic corner dedicated to the sanctuary of words, thoughts, and boundless imagination. Welcome to Book Reviews, where the tapestry of literary escapades intertwines with the infinite possibilities of the digital age. Here, amidst the pixels and code, stories breathe, characters dance, and pages whisper their tales to all who dare to listen.</p>";
                    echo "<p>In the annals of digital history, there exists a legend of two intrepid souls who dared to dream beyond the confines of conventional wisdom. Enter Jonathan Reed and Emily Smith, kindred spirits united by their unwavering passion for literature and their insatiable thirst for adventure.</p>";
                    echo "<p>Jonathan, a mild-mannered bibliophile with a penchant for tea and worn-out paperbacks, found solace in the pages of his favorite tomes, lost in worlds far removed from the humdrum of everyday life. Meanwhile, Emily, a spirited wordsmith with a knack for storytelling, spun tales that captivated hearts and stirred imaginations.</p>";
                    echo "<p>It was on a fateful evening, amidst the flickering glow of a computer screen, that destiny intervened. Jonathan and Emily, virtual voyagers navigating the vast expanse of the internet, stumbled upon each other in the digital ether. Sparks flew, ideas ignited, and thus, the seeds of Book Reviews were sown.</p>";
                    echo "<p>Time seemed to halt as they exchanged thoughts, their words flowing seamlessly through the interconnected web of cyberspace. Each keystroke felt like a step closer to unraveling the mysteries of literature and sharing their discoveries with the world. Jonathan, with his keen eye for detail, and Emily, with her boundless imagination, formed an unstoppable duo.</p>";
                    echo "<p>As they delved deeper into their shared passion for books, their virtual encounters evolved into late-night discussions and collaborative projects. The virtual world became their canvas, where they painted vivid portraits of characters, dissected intricate plots, and pondered the deeper meanings hidden within the pages.</p>";
                    echo "<p>With each review they crafted, they not only shared their insights but also forged connections with fellow book enthusiasts across the globe. Their humble corner of the internet blossomed into a vibrant community, united by a love for literature and a thirst for knowledge.</p>";
                    echo "<p>Through the ups and downs of life, Jonathan and Emily found solace in their digital sanctuary, where the possibilities were as endless as the vast expanse of the literary world. Together, they embarked on a journey of exploration and discovery, uncovering hidden gems and championing the voices of both established authors and emerging talents.</p>";
                    echo "<p>And so, as they look back on that fateful evening, they can't help but marvel at the serendipity that brought them together. What started as a chance encounter in the depths of cyberspace blossomed into a lifelong partnership fueled by their shared passion for literature and their unwavering belief in the power of words.</p>";
                            ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="about-section">
                  <?php 
                    // Second half of about
                    echo "<p>Fueled by their shared vision of creating a haven for bibliophiles across the globe, Jonathan and Emily embarked on a journey fraught with trials and triumphs. Armed with nothing but their love for literature and a dash of entrepreneurial spirit, they set out to bring their dream to life.</p>";
                    echo "<p>Drawing inspiration from the hallowed halls of ancient libraries and the bustling marketplaces of yore, they envisioned a virtual sanctuary where bookworms of all shapes and sizes could converge, share their love for reading, and embark on literary adventures aplenty.</p>";
                    echo "<p>Thus, Book Reviews was born—a digital oasis where readers could peruse an endless array of reviews, recommendations, and musings on the literary landscape. From timeless classics to hidden gems waiting to be discovered, no stone was left unturned in their quest to unearth the literary treasures of the world.</p>";
                    echo "<p>As word of their endeavor spread like wildfire across the digital realm, readers far and wide flocked to Book Reviews in search of their next literary obsession. What began as a humble website soon blossomed into a thriving community, a melting pot of ideas, opinions, and shared enthusiasm for the written word.</p>";
                    echo "<p>But with success came challenges, and Jonathan and Emily soon found themselves navigating treacherous waters fraught with competition, corporate intrigue, and the occasional rogue algorithm. Yet, fueled by their unwavering dedication and the unwavering support of their fellow bookworms, they persevered, weathering every storm that threatened to engulf their beloved haven.</p>";
                    echo "<p>What sets Book Reviews apart from the myriad of literary hubs that dot the digital landscape, you ask? Ah, dear reader, the answer lies not in algorithms or analytics, but in the very heart and soul of this enchanted realm.</p>";
                    echo "<p>For within the hallowed halls of Book Reviews, magic thrives in abundance, weaving its spell upon all who dare to venture within. It is a place where characters step off the page and into the hearts of readers, where stories transcend time and space to leave an indelible mark upon the tapestry of human experience.</p>";
                    echo "<p>But beware, dear reader, for not all is as it seems within these digital walls. Whispers of hidden agendas, clandestine meetings, and the occasional literary conspiracy abound, adding a dash of intrigue to an otherwise idyllic landscape.</p>";
                    echo "<p>And so, dear reader, we extend to you a heartfelt invitation to join us on this grand adventure. Whether you're a seasoned bibliophile or a fledgling bookworm taking your first tentative steps into the world of literature, there is a place for you within the hallowed halls of Book Reviews.</p>";
                    echo "<p>Welcome to Book Reviews, where every page is a new beginning, and every story is a chance to escape reality and embrace the boundless wonders of the written word.</p>";
                  ?>
                </div>
              </div>
            </div>
          </main>
        </div>
    </body>
</html>