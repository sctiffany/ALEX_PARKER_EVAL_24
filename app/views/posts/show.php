<?php include '../app/views/posts/_backHome.php' ?>

<div class="col-md-12 content-page">
    <div class="col-md-12 blog-post">
        <div>
            <img src="images/blog/1.jpg" alt="">
        </div>

        <!-- Post Headline Start -->
        <div class="post-title">
            <h1>
                <?php echo $post['title'] ?>
            </h1>
        </div>
        <!-- Post Headline End -->

        <!-- Post Detail Start -->
        <div class="post-info">
            <span><?php echo \Core\Helpers\formatDatetoEntireDate($post['postCreationDate']) ?></span> | <span><?php echo $post['name'] ?></span>
        </div>
        <!-- Post Detail End -->

        <p>
            <?php echo $post['text'] ?>
        </p>

        <!-- Post Blockquote (Italic Style) Start -->
        <blockquote class="margin-top-40 margin-bottom-40">
            <p>
                <?php echo $post['quote'] ?>
            </p>
        </blockquote>
        <!-- Post Blockquote (Italic Style) End -->

        <!-- Post Buttons -->
        <div>
            <a href="posts/<?php echo $post['postID'] ?>/<?php echo \Core\Helpers\slugify($post['title']) ?>/edit/form.html" type="button" class="btn btn-primary">Edit Post</a>
            <a
                href="posts/<?php echo $post['postID'] ?>/<?php echo \Core\Helpers\slugify($post['title']) ?>/delete.html"
                type="button"
                class="btn btn-secondary"
                role="button">Delete Post</a>
        </div>
        <!-- Post Buttons End -->
    </div>
</div>