<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand ps-2" href="/forum/index.php"><img id="logo" src="/forum/img/logo.png" alt="vDiscuss"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/forum/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Top Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $sql = "select cat_id,cat_title from `categories` limit 3";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['cat_id'];
                            echo '<li><a class="dropdown-item" href="/forum/threadlist.php?catid='.$id.'">'.$row['cat_title'].'</a></li>';
                        }
                        ?>    
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex my-2 me-2" action="/forum/search.php" method="get">
                    <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                <?php
                session_start();
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){
                    echo '<p class="text-light my-2 px-2">Welcome, <strong>'.$_SESSION['username'].'</strong></p>
                        <a class="btn btn-outline-success" data-bs-toggle="modal" href="#logoutModal" role="button">Logout</a>';
                }
                elseif (!isset($_SESSION['loggedin'])) {
                    echo '<a class="btn btn-outline-success" data-bs-toggle="modal" href="#loginModal" role="button">Login</a>
                    <a class="btn btn-outline-success mx-2" data-bs-toggle="modal" href="#signupModal" role="button">Signup</a>';
                }
                ?>
            </div>
        </div>
    </nav>

    <?php
    include '_modals.php';
    ?>