<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- FontAwesome API -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>vDiscuss - Coding Forums</title>
</head>

<body>
    <?php
    $showAlert = false;
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';    
    ?>

    <?php
    // if a thread has been clicked
    if (isset($_GET['threadid'])) {
        $id = $_GET['threadid'];
        // if the posting comments form was filled
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $desc = $_POST['comment'];
            $uid = $_POST['userid'];
            $uname = $_POST['username'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `user_id`) VALUES ('$desc', '$id', '$uid')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = "Your comment has been posted successfully.";
            }
            if ($showAlert) {
                echo '<div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> '.$showAlert.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
            }

        }// thread Jumbotron
        $sql = "SELECT * FROM `threads` WHERE thread_id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $th_title = $row['thread_title'];
        $th_desc = $row['thread_desc'];
        $uid = $row['user_id'];
        $dt = $row['timestamp'];
        $sql2 = "SELECT username FROM `users` WHERE user_id='$uid'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $uname = $row2['username'];
        echo '<div class="container p-5 my-4 bg-light rounded-3">
                <div class="container py-1">
                    <h1 class="display-5"><em>Problem: ' . $th_title . '</em></h1>
                    <p class="col-md-8 fs-5 font-weight-normal py-3"><em>' . $th_desc . '</em></p>
                    <hr>
                    <p class="mb-0">Asked by: <strong>'.$uname.'</strong></p>
                </div>
            </div>';
    }
    ?>

    <!-- Posting a comment on a thread -->
    <div class="container col-md-8 my-4">
        <h1>Leave a Comment</h1>
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
                        <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        <input type="hidden" id="userid" name="userid" value="'.$uid.'">
                    </div>
                    <button class="btn btn-success" type="submit">Post Comment</button>
                </form>';
        }
        else{
            echo '<p class="mt-3"><a style="text-decoration:none;" data-bs-toggle="modal" href="#loginModal" role="button">Login</a> or <a style="text-decoration:none;" data-bs-toggle="modal" href="#signupModal" role="button">Sign up</a> to post a comment.</p>';
        }
    echo '</div>';
    ?>

    <!-- Displaying comments -->
    <?php 
    $sql = "SELECT * FROM `comments` WHERE thread_id='$id'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows==0) {
        // <!-- if no comments are found -->
        echo '<div class="container p-5 my-4 bg-light rounded-3">
                <div class="container py-1">
                    <h1 class="display-5 fw-bold"><em>No Comments found.</em></h1>
                    <p class="col-md-8 fs-5 font-weight-normal py-3">Be the first person to comment/reply.</p>
                    <hr>       
                </div>
            </div>';   
    }
    else {
        // <!-- if comments are found, display them -->
        echo '<div class="container col-md-8">
                <h1 class="my-3">Browse Discussions</h1>';
        while($row = mysqli_fetch_assoc($result)){
            $desc = $row['comment_content'];
            $uid = $row['user_id'];
            $dt = $row['timestamp'];
            $sql2 = "SELECT username FROM `users` WHERE user_id='$uid'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $uname = $row2['username'];
            echo '<div class="row my-4 shadow p-3 bg-body rounded">
                        <img class="col-md-2 mx-3 px-0" src="img/user.jpg" alt="user" style="max-width:55px; max-height:55px">
                        <div class="container col-md-10 mx-0">
                            <h6><strong class="fs-6 badge bg-success">'.$uname.'</strong> replied <i class="fa fa-arrow-circle-o-down"></i><span class="badge bg-light text-dark">'.substr($dt, 0, 10).' at '.substr($dt, 11).'</span></h6>
                            <p>'.$desc.'</p>
                        </div>
                    </div>';
        }
        echo '</div>';
        
    }
    
    
    include 'partials/_footer.php'
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