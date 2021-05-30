<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    @media only screen and (max-width: 768px) {
        .row{
            justify-content: center;
        }
        #categories{
            width: 75vw;
        }
    }
    #logo{
        max-height: 50px;
    }
    @media only screen and (min-width: 769px) {
        #categories{
            width: 40vw;
        }
    }
    
    </style>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>vDiscuss - Coding Forums</title>
</head>

<body>
    <?php
    include 'partials/_dbconnect.php';
    include 'partials/_header.php';

    // if login was successful
    if(isset($_GET['sin']) && $_GET['sin']=='t'){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){
            echo '<div>
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <strong>Success!</strong> You have successfully logged into your account.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>';
        }
    }
    // if signup was successful
    if(isset($_GET['ins']) && $_GET['ins']=='true'){
        echo '<div>
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <strong>Success!</strong> You can now log into your account.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
    }
    // if signup form was filled and wasn't successful
    elseif (isset($_GET['err']) && $_GET['err']!='false') {
        echo '<div>
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <strong>Sorry!</strong> '.$_GET['err'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
    }
    ?>

    <!-- Carousel starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1500x500/?programmer,code,computer" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1500x500/?programming,keyboard,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1500x500/?laptop,coding" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories -->
    <div class="container" style="min-height: 80vh;">
        <h1 class="text-center my-4"><img id="categories" class="img-responsive" src="/forum/img/browse.png" alt="Browse Categories"></h1>
        <div class="row">

            <?php
            $sql = "select * from `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['cat_id'];

                echo '
                <div class="shadow bg-body rounded card col-xs-12 col-md-4 mx-2 px-0 my-3" style="max-width:31%;min-width:300px">
                    <img src="img/card' . $id . '.jpg" style="max-height:150px; min-width:100%;" class="card-img-top" alt="...">
                    <div class="card-body">
                    <a href="/forum/threadlist.php?catid='.$id.'" style="text-decoration:none;"><h5 class="card-title" style="color:black;"><strong>' . $row['cat_title'] . '</strong></h5></a>
                        <p class="card-text">' . substr($row['cat_desc'], 0, 150) . '...</p>
                        <a href="/forum/threadlist.php?catid='.$id.'" class="btn btn-success">Explore</a>
                    </div>
                </div>
                ';
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
    <style>
    /* div.card{
        opacity:0.8;
    } */
    div.card:hover{
        /* -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1); */
        transform: translateY(-7px);
        /* transform: skew(-10deg); */
    }
    </style>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>