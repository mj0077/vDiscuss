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
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';
    ?>

    <!-- Categories -->
    <div class="container px-5" style="min-height: 80vh;">
        <h1 class="my-3">Search results for "<?php if(isset($_GET['query'])) echo $_GET['query']?>":</h1>
        <div class="row">

            <?php
            if(isset($_GET['query'])){
                $query = $_GET['query'];
                $sql = "SELECT thread_id,thread_title,thread_desc FROM `threads` WHERE MATCH(`thread_title`,`thread_desc`) against('$query')";
                $result = mysqli_query($conn, $sql);
                $numRows = mysqli_num_rows($result);
                if ($numRows) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['thread_id'];
                        $title = $row['thread_title'];
                        $desc = $row['thread_desc'];
                    echo '<div class="row my-2 shadow p-3 bg-body rounded">
                            <img class="col-md-2 mx-3 px-0" src="img/user.jpg" alt="user" style="max-width:55px; max-height:55px">
                            <div class="container col-md-8 mx-0">
                                <div class="row my-0" style="width:max-parent;padding-bottom:-5px">
                                    <h5 style="width:max-content;margin:0 4px 0 0; overflow-wrap:anywhere;">
                                        <a class="text-success py-2" style="text-decoration:none;" href="thread.php?threadid='.$id.'">'.$title.'</a>
                                    </h5>
                                </div>
                                <p class="mt-1">'.$desc.'</p>
                            </div>
                        </div>';
                    }
                }
                else{
                    echo '<div class="container p-3 my-2 bg-light rounded-3">
                            <div class="container py-1">
                                <h1 class="display-5 fw-bold"><em>No results were found.</em></h1>
                                <hr>       
                                <p class="col-md-8 fs-5 font-weight-normal">Suggestions:<ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li></p>
                            </div>
                        </div>'; 
                }
            }

            ?>

        </div>
    </div>

    <?php
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