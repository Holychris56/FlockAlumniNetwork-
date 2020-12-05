<nav class="navbar navbar-expand-md primary-bg navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php"><img src="images/logo2.png" style="height: 100px;" alt=""></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
            <div class="d-flex">
                <div class="left">
                    <span><?= $user['name'] ?></span>
                    <a class="small py-0 nav-link text-right" href="logout.php">Logout</a>
                </div>
                <img src="uploads/<?= $user['avatar'] ?>" class="img-round" style="width: 40px;" alt="">
            </div>
        </li>
      </ul>
  </div>
</nav>
