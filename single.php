<?php

include("path.php");
include(ROOT_PATH . "/app/controllers/posts.php");
include(ROOT_PATH . "/app/controllers/comments.php");

if(isset($_GET['id'])) {
  $post = selectOne('Posts', ['id' => $_GET['id']]);
  $comments = showComments($_GET['id']);
}

$posts = selectAll('Posts', ['published' => 1]);
$topics = selectAll('Topics');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title><?php echo $post['title']; ?> | TranVinhLab</title>
</head>

<body>
  
  <!-- Facebook Page Plugin SDK 
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=285071545181837&autoLogAppEvents=1">
  </script>-->

  <?php include(ROOT_PATH . "/app/includes/header.php"); ?>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Content -->
    <div class="content clearfix">

      <!-- Main Content Wrapper -->
      <div class="main-content-wrapper">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['title'] ?></h1>

          <div class="post-content">
            <?php echo html_entity_decode($post['body']) ?>
          </div>
          
        </div>
         
      </div>
      <!-- // Main Content -->

     

      <!-- Sidebar -->
      <div class="sidebar single">

        <!-- <div class="fb-page" data-href="https://web.facebook.com/codingpoets/" data-small-header="false"
          data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
          <blockquote cite="https://web.facebook.com/codingpoets/" class="fb-xfbml-parse-ignore"><a
              href="https://web.facebook.com/codingpoets/">Coding Poets</a></blockquote>
        </div> -->

        <div class="section popular">
          <h2 class="section-title">Popular</h2>

          <?php foreach($posts as $p): ?>
            <div class="post clearfix">
              <img src="<?php echo "assets/images/" . $p['image'] ?>" alt="">
              <a href="single.php?id=<?php echo $p['id'] ?>" class="title">
                <h4><?php echo $p['title'] ?></h4>
              </a>
            </div>
          <?php endforeach; ?>
          
        </div>

        <div class="section topics">
          <h2 class="section-title">Topics</h2>
          <ul>
            
            <?php foreach($topics as $key => $topic): ?>
              <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name']; ?>"><?php echo $topic['name']; ?></a></li>
            <?php endforeach; ?>
            
          </ul>
        </div>
      </div>
      <!-- // Sidebar -->

    </div>
    <!-- // Content -->

    <!-- // Comments -->
          
    <div class="comment-section">
      <div class="comment-title">
        <h3>Comments</h3>
      </div>

      <form action="" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
        <textarea name="content" id="" cols="30" rows="10"></textarea>
        <button type="send" name='send-comment'>Comment</button>
      </form>
      
      <!-- Show comments -->
      <?php foreach($comments as $cmt): ?>
        <div class="comments">
          <h4 class="user">
            <?php echo $cmt['username'] ?>
          </h4>
          <span class="datetime"><?php echo $cmt['created_at'] ?></span>
          <div class="clearfix"></div>
          <p class="content-comment"><?php echo $cmt['content'] ?></p>
        </div>
      <?php endforeach; ?>

    </div>

    <!-- // Comments -->

  </div>
  <!-- // Page Wrapper -->

  <!-- footer -->
  <?php include(ROOT_PATH . "/app/includes/footer.php") ?>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


  <!-- Slick Carousel -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>