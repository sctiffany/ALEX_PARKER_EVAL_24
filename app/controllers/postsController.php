<?php

namespace App\Controllers\PostsController;

use \PDO;

function indexAction(PDO $connexion)
{
    include_once "../app/models/postsModel.php";
    $posts = \App\Models\PostsModel\findAll($connexion);

    global $content, $title;
    $title = "Blog";
    ob_start();
    include "../app/views/posts/index.php";
    $content = ob_get_clean();
}

function showAction(PDO $connexion, int $id)
{
    include_once '../app/models/postsModel.php';
    $post = \App\Models\PostsModel\findOneById($connexion, $id);

    global $content, $title;
    $title = $post['title'];
    ob_start();
    include '../app/views/posts/show.php';
    $content = ob_get_clean();
}
