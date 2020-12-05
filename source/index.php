<?php include_once('inc/header.php'); ?>
<?php if (!isset($_SESSION['user'])){
    // header('Location: login.php');
    // exit;
} ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card my-3">
                <div class="card-body">
                    <?php if (isset($_SESSION['alert'])): ?>
                        <div class="alert <?= $_SESSION['alert-class'] ?>"><?= $_SESSION['alert'] ?></div>
                    <?php unset($_SESSION['alert']);endif; ?>
                    <form action="server.php" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <img src="uploads/<?= $user['avatar'] ?>" height="60px" class="img-round" alt="">
                            </div>
                            <div class="col-md-8">
                                    <textarea name="content" class="form-control" placeholder="Post an update"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="image"><img src="images/upload.png" height="60px" alt=""></label>
                                <input type="file" name="image" class="d-none" id="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <input type="submit" name="post" class="btn primary-bg" value="Post">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                $sql = "SELECT *,p.created_at as post_time,p.id as post_id FROM posts as p, users as u WHERE p.user = u.id ORDER BY p.id DESC";
                $posts = [];
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()){
                    $posts[] = $row;
                }
                foreach($posts as $post):
            ?>
            <div class="card my-3" id="post-<?= $post['post_id'] ?>">
                <div class="card-body">
                    <div class="row">
                        <?php if ($post['user'] == $user['id']): ?>
                            <div class="dlt-btn">
                                <div class="dropdown d-inline-block">
                                    <i style="cursor:pointer;" class="btn-sm btn primary-bg dropdown-toggle" data-toggle="dropdown"></i>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" onclick="return confirm('are you sure?')" class="small primary-color d-block dlt-post"  data-id="<?= $post['post_id'] ?>" style="text-decoration: none;" >Delete</a></li>
                                        </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12 d-flex mb-3">
                            <div style="width: 60px;">
                                <img src="uploads/<?= $post['avatar'] ?>" height="50px" class="img-round" alt="">
                            </div>
                            <div class="post pl-2">
                                <h5 class="primary-color font-weight-bold mb-1"><a class="primary-color" href="profile.php?user=<?= $post['user'] ?>"><?= $post['name'] ?></a></h5>
                                <p class="text-muted small"><?= date('d M Y h:m A', strtotime($post['post_time'])) ?></p>
                                <div class="mt-3 post-content">
                                    <p><?= $post['content'] ?></p>
                                </div>
                                <?php if (!empty($post['image'])): ?>
                                    <img src="uploads/<?= $post['image'] ?>" alt="" class="img-fluid">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="comments w-100">
                            <?php
                                $comments = [];
                                $post_id = $post['post_id'];
                                $sql = "SELECT * FROM comments as c, users as u WHERE c.user = u.id AND c.post='$post_id'";
                                $res = $conn->query($sql);
                                while($row = $res->fetch_assoc()){
                                    $comments[] = $row;
                                }
                                foreach($comments as $comment):
                            ?>
                            <div class="col-md-12 d-flex border-top py-2">
                                <div style="width: 60px;">
                                    <img src="uploads/<?= $comment['avatar'] ?>" height="40px" class="img-round" alt="">
                                </div>
                                <div class="post pl-2">
                                    <h6 class="font-weight-bold primary-color mb-1"><a class="primary-color" href="profile.php?user=<?= $comment['user'] ?>"><?= $comment['name'] ?></a> * <small>Graduated in <?= $comment['grad_year'] ?></small></h6>
                                    <p class="comment"><?= $comment['comment'] ?></p>
                                </div>
                            </div>

                            <?php endforeach; ?>
                        </div>

                        <div class="col-md-12 d-flex border-top py-2">
                            <div style="width: 60px;">
                                <img src="uploads/<?= $user['avatar'] ?>" height="40px" class="img-round" alt="">
                            </div>
                            <div class="post pl-2 w-100">
                                <form action="#" method="post" id="comment-form">
                                    <div class="row">
                                        <div class="form-group col-md-9">
                                            <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                            <input type="hidden" name="user" value="<?= $user['id'] ?>">
                                            <input type="text" class="form-control" name="comment" value="" placeholder="Write your comment here..." required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" class="btn primary-bg" value="Comment">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include_once('inc/footer.php'); ?>
<script charset="utf-8">
    $("#comment-form").on('submit',(e)=>{
        e.preventDefault();
        form_data = $(e.target).serialize();
        $this = $(e.target);
        $.ajax({
            url: 'server.php',
            method: 'POST',
            data: form_data,
            success: (r)=>{
                if (r == '-1') {
                    alert('Something went wrong');
                    return false;
                }else{
                    resp = JSON.parse(r);
                    $("#post-"+resp.post).find('.comments').append(resp.html);
                    $this.find('[name="comment"]').val('');
                }
            }
        });
    });

    $(".dlt-post").on('click', (e)=>{
        e.preventDefault();
        id = $(e.target).data('id');
        $.ajax({
            url: 'server.php',
            method: 'POST',
            data: {
                dlt_post: id
            },
            success: (r)=>{
                if (r == '-1') {
                    alert('Something went wrong');
                    return false;
                }else{
                    $("#post-"+r).fadeOut();
                }
            }
        });
    });
</script>
