<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <title>vDiscuss - Coding Forums</title>
</head>

<body>
    <?php
    $showAlert = false;
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';    
    ?>

    <?php
    //<!--  -->
    // if just a category is explored
    if (isset($_GET['catid'])) {
        $id = $_GET['catid'];
        // if the question form was filled
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $uid = $_POST['userid'];
            $title = $_POST['threadtitle'];
            $desc = $_POST['threaddesc'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `cat_id`, `user_id`) VALUES ('$title', '$desc', '$id', '$uid')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = "You asked a question. Please wait for the community to respond.";
            }
            if ($showAlert) {
                echo '<div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> '.$showAlert.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
            }

        }
        $sql = "SELECT * FROM `categories` WHERE cat_id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $cat_title = $row['cat_title'];
        $cat_desc = $row['cat_desc'];
        echo '<div class="container p-5 my-4 bg-light rounded-3">
                <div class="container py-1">
                    <h1 class="display-5 fw-bold"><em>Welcome to ' . $cat_title . ' forums</em></h1>
                    <p class="col-md-8 fs-5 font-weight-normal py-3"><em>' . $cat_desc . '</em></p>
                    <hr>
                    <p class="mb-0">No Spam / Advertising / Self-promote in the forums.
                    Do not post copyright-infringing material. 
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                    Do not PM users asking for help.
                    Remain respectful of other members at all times.</p>
                </div>
            </div>';
    }
    ?>

    <!-- Asking a question -->
    <div class="container col-md-8 my-4">
        <h1>Ask a Question</h1>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){
            $uname = $_SESSION['username'];
            $sql = "SELECT * FROM `users` WHERE username='$uname'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            // echo var_dump($row);
            $uid = $row['user_id'];
            echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="mb-3">
                    <label for="threadtitle" class="form-label">Question</label>
                    <input type="text" class="form-control" id="threadtitle" name="threadtitle" placeholder="Enter your question" required>
                </div>
                <div class="mb-3">
                    <label for="threaddesc" class="form-label">Elaborate your problem</label>
                    <textarea class="form-control" id="threaddesc" name="threaddesc" rows="3" required></textarea>
                    <input type="hidden" id="userid" name="userid" value="'.$uid.'">
                    <input type="hidden" id="username" name="username" value="'.$uname.'">
                </div>
                <button class="btn btn-success" type="submit">Ask Question</button>
            </form>';
        }
        else{
            echo '<p class="mt-3"><a style="text-decoration:none;" data-bs-toggle="modal" href="#loginModal" role="button">Login</a> or <a style="text-decoration:none;" data-bs-toggle="modal" href="#signupModal" role="button">Sign up</a> to ask a question.</p>';
        }
        ?>
    </div>

    <?php 
    $sql = "SELECT * FROM `threads` WHERE cat_id='$id'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows==0) {
        // <!-- if no threads are found -->
        echo '<div class="container p-5 my-4 bg-light rounded-3">
                <div class="container py-1">
                    <h1 class="display-5 fw-bold"><em>No Threads found.</em></h1>
                    <p class="col-md-8 fs-5 font-weight-normal py-3">Be the first person to start a thread.</p>
                    <hr>       
                </div>
            </div>';   
    } // Browse Queries
    else {
        // <!-- if threads are found, display them -->
        echo '<div class="container col-md-8">
                <h1 class="my-3">Browse Queries</h1>';
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $uid = $row['user_id'];
            $dt = $row['timestamp'];
            $sql2 = "SELECT username FROM `users` WHERE user_id='$uid'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $uname = $row2['username'];
            echo '<div class="row my-4 shadow p-3 bg-body rounded">
                        <img class="col-md-2 mx-3 px-0" src="img/user.jpg" alt="user" style="max-width:55px; max-height:55px">
                        <div class="container col-md-8 mx-0">
                            <div class="row my-0" style="width:max-parent;padding-bottom:-5px">
                                <h5 style="width:max-content;margin:0 4px 0 0; overflow-wrap:anywhere;">
                                    <a class="text-success py-2" style="text-decoration:none;" href="thread.php?threadid='.$id.'">'.$title.'</a>
                                </h5>
                            </div>
                            <p class="mt-1">'.$desc.'</p>
                        </div>
                        <div class="container col-md-2 mx-0" style="align-items:center;">
                            <small style="float:left; margin:0;">Asked by:<br><span style="letter-spacing: 0.8px;" class="badge bg-success"><em>'.$uname.'</em></strong></span></small>
                            <span class="badge bg-light text-dark">'.substr($dt, 0, 10).' at '.substr($dt, 11).'</span>
                        </div>
                    </div>';
        }
        echo '</div>';
    }
    include 'partials/_footer.php';
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>