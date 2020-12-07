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

    h1 {
        color: #000;
    }

    h3 {
        color: #000;
        font-size:20px;
        padding-top:10px;
    }

    h5 {
        color: #000;
        font-size: 16px;
    }

    .flex-container > div {
    background-color: #ddd;
    border: 1px solid #ccc;
    margin: 10px;
    padding: 10px;
    font-size: 30px;
    color: #333;
    text-align: center;
}

.flex-container > div >img {
    width:200px;
}

.flex-container > div >a {
    font-size:16px;
    font-weight:600;
    color: #78232d;
}

</style>
<div class="container" style="background-color: #78232d; color: #fff4e0">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card my-3">
                <div class="card-body">
                <h1>Alumni Association Officers</h1>
                    <div class="row flex-container">
                        <div><img src="images/male1.jpg"> 
                        <h3>Aaron Roberts</h3>
                        <h5>Class of 94</h5>
                        <a href="#">Contact</a>
                        </div>
                        <div><img src="images/female1.jpg">
                        <h3>Sondra Day</h3>
                        <h5>Class of 97</h5>
                        <a href="#">Contact</a>
                    </div>
                        <div><img src="images/male3.jpg">
                        <h3>Nicholas Franklin</h3>
                        <h5>Class of 09</h5>
                        <a href="#">Contact</a></div> 
                        <div><img src="images/female2.jpg">
                        <h3>Mandy Barth</h3>
                        <h5>Class of 14</h5>
                        <a href="#">Contact</a></div>  
                
                        
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
