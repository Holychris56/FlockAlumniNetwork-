<?php include_once('inc/header.php'); ?>
<?php if (!isset($_SESSION['user'])){
    header('Location: login.php');
    exit;
} ?>

<style>
    body {
        background-color: #78232d;
    }
    .flex-container {
    display: flex;
    flex-wrap: wrap;
    }

    .flex-item-left {
    flex: 50%;
    color: #333;
    padding: 0 10px;
    /* background-color: pink */
    }

    .flex-item-right {
    flex: 50%;
    color: #333;
    padding: 0 10px;
    /* background-color: darkgrey; */
    }

    /* Responsive layout - makes a one column layout (100%) instead of a two-column layout (50%) */
    @media (max-width: 800px) {
    .flex-item-right, .flex-item-left {
        flex: 100%;
    }
    }
</style>
<div class="container" style="background-color: #78232d; color: #fff4e0">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="my-3">
                <h1>Striving for excellence...</h1>
                <h4 style="text-align:right;">...through hard work and discipline</h4>
            </div>

           
            <div class="card my-3">
                <div class="card-body">
                    <div class="row flex-container">
                        <div class="flex-item-left">
                            <img src="images/grad1.jpg" style="width: 100%;">
                        </div>
                        <div class="flex-item-right">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div>

                    <div class="row flex-container">
                        <div class="flex-item-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non 
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                            
                        <div class="flex-item-right">
                            <img src="images/girls1.jpg" style="width: 100%;">
                        </div>
                        <div style="width:100%; text-align:center; margin-top:15px; font-weight:600">
                                        <p> <a target="_blank" href="https://www.facebook.com/maggottyhighschool"> Visit us on Facebook!</a> </p></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php include_once('inc/footer.php'); ?>
<script charset="utf-8">
    $(".comment-form").on('submit',(e)=>{
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
