<?php require_once 'functions.php';
function createHeader(): string
{
    $header = '<html lang="en">
     <head>
        <title>OnlineBookStore</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
              crossorigin="anonymous">
    </head>

    <body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">BookStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                    </ul>';
            if (isLoggedIn() && isUser()) {
                $header .=
                    ' <div class="nav-item m-1">
                          <a class="nav-link active" aria-current="page" href="cart.php">Cart</a>
                     </div>';
            }
            $header .=
                    '<a href="login-form.php">
                            <button class="btn btn-outline-success">Login</button>
                    </a>
                </div>
            </div>
        </nav>';

    return $header;
}