<?php include_once('inc/header.php'); ?>
<?php if (!isset($_SESSION['user'])){
    header('Location: login.php');
    exit;
} ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card my-3">
                <div class="card-body">
                    <h3 class="font-weight-bold primary-color">Update Profile</h3>
                    <?php if (isset($_SESSION['alert'])): ?>
                        <div class="alert <?= $_SESSION['alert-class'] ?>"><?= $_SESSION['alert'] ?></div>
                    <?php unset($_SESSION['alert']);endif; ?>
                    <form action="server.php" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="location" value="<?= $user['location'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Graduation Year</label>
                            <input type="number" name="year" class="form-control" placeholder="Graduation year" required value="<?= $user['grad_year'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="<?= $user['fb'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="url" class="form-control" name="insta" value="<?= $user['insta'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea required name="bio" class="form-control"><?= $user['bio'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Avatar <small>(Leave empty if you don't wanna change)</small></label>
                            <input type="file" class="form-control" name="avatar" value="">
                        </div>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <div class="form-group">
                            <button type="submit" name="update" class="btn primary-bg">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('inc/footer.php'); ?>
