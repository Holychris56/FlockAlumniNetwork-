<?php
    require('inc/db.php');

    // Register
    if (isset($_POST['register'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $sql = "SELECT * FROM users WHERE email='$email'";
        if ($conn->query($sql)->num_rows > 0) {
            $_SESSION['alert'] = 'This email is already registered.';
            $_SESSION['alert-class'] = 'alert-danger';
            header('Location: register.php');
        }else{
            $sql = "INSERT INTO users (name, email, password, location, grad_year) VALUES('$name', '$email', '$password', '$location', '$year')";
            if ($conn->query($sql)) {
                $_SESSION['alert'] = 'Registration successful';
                $_SESSION['alert-class'] = 'alert-success';
                header('Location: login.php');
            }else{
                $_SESSION['alert'] = 'Something went wrong.';
                $_SESSION['alert-class'] = 'alert-danger';
                header('Location: register.php');
            }
        }
    }

    // Login
    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        if ($conn->query($sql)->num_rows > 0) {
            $user = $conn->query($sql)->fetch_assoc();
            $_SESSION['user'] = $user['id'];
            header('Location: index.php');
        }else{
            $_SESSION['alert'] = 'Invalid email or password.';
            $_SESSION['alert-class'] = 'alert-danger';
            header('Location: login.php');
        }
    }

    // Update Profile
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
        $insta = mysqli_real_escape_string($conn, $_POST['insta']);
        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
        if (!empty($_FILES['avatar']['name'])) {
            $file = uniqid().$_FILES['avatar']['name'];
            move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/$file");
            $sql = "UPDATE users SET name='$name', location='$location', fb='$facebook', insta='$insta', grad_year='$year', bio='$bio', avatar='$file' WHERE id='$id'";
        }else{
            $sql = "UPDATE users SET name='$name', location='$location', fb='$facebook', insta='$insta', grad_year='$year', bio='$bio' WHERE id='$id'";
        }
        if ($conn->query($sql)) {
            $_SESSION['alert'] = 'Profile updated.';
            $_SESSION['alert-class'] = 'alert-success';
            header('Location: profile.php');
        }else{
            $_SESSION['alert'] = 'Something went wrong.';
            $_SESSION['alert-class'] = 'alert-danger';
            header('Location: update.php');
        }
    }

    // Add Post
    if (isset($_POST['post'])) {
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $file = '';
        if (!empty($_FILES['image']['name'])) {
            $file = uniqid().$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$file");
        }
        $sql = "INSERT INTO posts (user, content, image) VALUES('".$_SESSION['user']."', '$content', '$file')";
        if ($conn->query($sql)) {
            $_SESSION['alert'] = 'Post added successfully.';
            $_SESSION['alert-class'] = 'alert-success';
            header('Location: index.php');
        }else{
            $_SESSION['alert'] = 'Something went wrong.';
            $_SESSION['alert-class'] = 'alert-danger';
            header('Location: index.php');
        }
    }

    // DELETE Post
    if (isset($_POST['dlt_post'])) {
        $id = $_POST['dlt_post'];
        $sql = "DELETE FROM posts WHERE id='$id'";
        if ($conn->query($sql)) {
            echo $id;
        }else{
            echo '-1';
        }
        exit;
    }

    // Add Comment
    if (isset($_POST['comment'])) {
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        $post = mysqli_real_escape_string($conn, $_POST['post_id']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user']);
        $sql = "SELECT * FROM users WHERE id='$user_id'";
        $user = $conn->query($sql)->fetch_assoc();
        $sql = "INSERT INTO comments (user, comment, post) VALUES('$user_id', '$comment', '$post')";
        if ($conn->query($sql)) {
            $html = "<div class='col-md-12 d-flex border-top py-2'>
                <div style='width: 60px;''>
                    <img src='uploads/".$user['avatar']."' height='40px' class='img-round'>
                </div>
                <div class='post pl-2'>
                    <h6 class='font-weight-bold primary-color mb-1'>".$user['name']." * <small>Graduated in ".$user['grad_year']."</small></h6>
                    <p class='comment'>".$comment."</p>
                </div>
            </div>";
            echo json_encode([
                'post' => $post,
                'html' => $html
            ]);
        }else{
            echo '-1';
        }
        exit;
    }
 ?>
