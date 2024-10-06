<?php include_once '../app/views/templates/partials/_buttonAddPost.php' ?>
<?php foreach ($posts as $post): ?>
    <div class="col-md-12 blog-post row">
        <div class="post-title">
            <a href="posts/<?php echo $post['postID'] ?>/<?php echo \Core\Helpers\slugify($post['title']) ?>.html">
                <h1>
                    <?php echo $post['title'] ?>
                </h1>
            </a>
        </div>
        <div class="post-info">
            <span><?php echo \Core\Helpers\formatDate($post['postCreationDate']) ?></span> | <span><?php echo $post['name'] ?></span>
        </div>
        <p>
            <?php echo \Core\Helpers\truncate($post['text'], 150) ?>
        </p>
        <a
            href="posts/<?php echo $post['postID'] ?>/<?php echo \Core\Helpers\slugify($post['title']) ?>.html"
            class="
                        button button-style button-anim
                        fa fa-long-arrow-right
                      "><span>Read More</span></a>
    </div>
<?php endforeach; ?>
<?php include_once '../app/views/templates/partials/_nav.php' ?>