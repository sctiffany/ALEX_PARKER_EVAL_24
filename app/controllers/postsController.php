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

function addFormAction(PDO $connexion)
{
    include_once '../app/models/categoriesModel.php';
    $categories = \App\Models\CategoriesModel\findAll($connexion);

    global $content, $title;
    $title = "Add a post";
    ob_start();
    include '../app/views/posts/addForm.php';
    $content = ob_get_clean();
}

function addInsertAction(PDO $connexion, array $data = null)
{
    include_once '../app/models/postsModel.php';
    $id = \App\Models\PostsModel\insertOne($connexion, $data);

    header('Location: ' . BASE_PUBLIC_URL);
}

function editFormAction(PDO $connexion, int $id)
{
    include_once '../app/models/postsModel.php';
    $post = \App\Models\PostsModel\findOneById($connexion, $id);

    include_once '../app/models/categoriesModel.php';
    $categories = \App\Models\CategoriesModel\findAll($connexion);

    global $content, $title;
    $title = "Edit a post";
    ob_start();
    include_once '../app/views/posts/editForm.php';
    $content = ob_get_clean();
}

function editUpdateAction(PDO $connexion, int $id, array $data = null)
{

    include_once '../app/models/postsModel.php';
    $return = \App\Models\PostsModel\updateOneById($connexion, $id, $data);

    header('Location: ' . BASE_PUBLIC_URL);
}
