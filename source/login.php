<?php include_once('inc/header.php'); ?>
<style media="screen">
body,html{
    height:100% !important;
}
.card{
    box-shadow: 0 0 4px 1px rgba(0,0,0,.2);
}
@media screen and (max-width: 600px){
    .logo{
        width: 200px;
    }
}
</style>
<div class="container h-100">
    <div class="row h-100  justify-content-center align-items-center">
        <div class="col-md-5 py-3 text-center">
            <img src="images/logo-full.png" class="img-fluid logo" alt="">
        </div>
        <div class="col-md-5 py-3">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($_SESSION['alert'])): ?>
                        <div class="alert <?= $_SESSION['alert-class'] ?>"><?= $_SESSION['alert'] ?></div>
                    <?php unset($_SESSION['alert']);endif; ?>
                    <form action="server.php" method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="font-weight-bold btn primary-bg btn-block" value="Login" name="login">
                        </div>
                        <hr>
                        <div class="form-group">
                            <a href="register.php" class="font-weight-bold btn btn-warning btn-block">Create new account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('inc/footer.php'); ?>
