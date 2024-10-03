<?php
// ROUTE DES POSTS
// PATTERN : /?posts
if (isset($_GET['posts'])) {
    include '../app/routers/posts.php';
} else {
    // ROUTE par défaut:
    // PATTERN: /
    // CTRL: postsController
    // ACTION: index
    include_once "../app/controllers/postsController.php";
    App\Controllers\PostsController\indexAction($connexion);
}
