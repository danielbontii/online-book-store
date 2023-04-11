<?php
include '_header.php';
echo createHeader();

?>

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-75">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" >
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Sign in</h3>
                        <form method="post" action="login.php">

                            <div class="form-outline mb-4">
                                <input type="username" id="email" class="form-control form-control-lg" name="username"/>
                                <label class="form-label" for="email">Username</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" class="form-control form-control-lg"
                                       name="password"/>
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <button class="btn btn-secondary btn-lg btn-block" type="submit">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '_footer.php' ?>
