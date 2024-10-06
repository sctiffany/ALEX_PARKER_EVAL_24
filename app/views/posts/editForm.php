<?php include '../app/views/posts/_backHome.php' ?>
<div class="col-md-12 content-page">
    <div class="col-md-12 blog-post">
        <!-- Post Headline Start -->
        <div class="post-title">
            <h1>Post Form</h1>
        </div>
        <!-- Post Headline End -->

        <!-- Form Start -->
        <form action="posts/<?php echo $post['postID'] ?>/<?php echo \Core\Helpers\slugify($post['title']) ?>/edit/update.html" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="form-control"
                    placeholder="Enter your title here"
                    value="<?php echo $post['title'] ?>" />
            </div>
            <div class="form-group">
                <label for="text">Text</label>
                <textarea
                    id="text"
                    name="text"
                    class="form-control"
                    rows="5"
                    placeholder="Enter your text here"><?php echo $post['text'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1"> Image</label>
                <input type="file" class="form-control-file btn btn-primary" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="text">Quote</label>
                <textarea
                    id="quote"
                    name="quote"
                    class="form-control"
                    rows="5"
                    placeholder="Enter your quote here"><?php echo $post['quote'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="text">Category</label>
                <select
                    id="category"
                    name="category_id"
                    class="form-control">
                    <option value="<?php echo $post['category_id']; ?>" selected>
                        <?php echo $post['name']; ?>
                    </option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <input
                    class="btn btn-primary"
                    type="submit"
                    value="submit" />
                <input
                    class="btn btn-secondary"
                    type="reset"
                    value="reset" />
            </div>
        </form>
        <!-- Form End -->
    </div>
</div>