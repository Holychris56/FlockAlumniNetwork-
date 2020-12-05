<?php include_once('inc/header.php'); ?>
<?php if (!isset($_SESSION['user'])){
    header('Location: login.php');
    exit;
}
if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $user = $conn->query($sql)->fetch_assoc();
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card my-3">
                <div class="card-body">
                    <?php if (isset($_SESSION['alert'])): ?>
                        <div class="alert <?= $_SESSION['alert-class'] ?>"><?= $_SESSION['alert'] ?></div>
                    <?php unset($_SESSION['alert']);endif; ?>
                    <img src="uploads/<?= $user['avatar'] ?>" style="width: 250px;height: 250px;" class="float-right" alt="">
                    <h4 class="primary-color font-weight-bold"><?= $user['name'] ?></h4>
                    <p class="primary-color">Graduation Year' <b><?= $user['grad_year'] ?></b></p>
                    <?php if ($user['id'] == $_SESSION['user']): ?>
                        <a href="update.php" class="btn btn-sm primary-bg">Edit Profile</a>
                    <?php endif; ?>
                    <hr>
                    <p class="mb-1">Lives in <b class="primary-color"><?= $user['location'] ?></b></p>
                    <p>
                        <a class="social-link bg-dark img-round p-2" href="mailto:<?= $user['email'] ?>"><i class="fas text-white fa-envelope"></i></a>
                        <a class="social-link bg-dark img-round p-2" href="<?= $user['fb'] ?>" target="_blank"><i class="fab text-white fa-facebook-f"></i></a>
                        <a class="social-link bg-dark img-round p-2" href="<?= $user['insta'] ?>" target="_blank"><i class="fab text-white fa-instagram"></i></a>
                    </p>
                    <p class="mb-1 font-weight-bold primary-color">About Me</p>
                    <p><?= empty($user['bio'])?'<small class="text-muted">No information found!</small>':$user['bio'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('inc/footer.php'); ?>
