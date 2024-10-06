<?php

namespace App\Controllers\PostsController;

use \PDO;

function indexAction(PDO $connexion, int $page = 1)
{
    include_once "../app/models/postsModel.php";

    $limit = 3;
    $offset = ($page - 1) * $limit;

    $posts = \App\Models\PostsModel\findAll($connexion, $limit, $offset);
    $totalPosts = \App\Models\PostsModel\countAll($connexion);
    $totalPages = ceil($totalPosts / $limit);

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
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $temporaryImagePath = $_FILES['image']['tmp_name']; // Chemin temporaire du fichier image uploadé
        $finalImagePath = basename($_FILES['image']['name']); // Nom du fichier image uploadé (sans le chemin)

        // Déplacez le fichier uploadé vers le dossier cible
        if (move_uploaded_file($temporaryImagePath, $finalImagePath)) {
            // Si l'upload réussit, ajoutez le chemin de l'image aux données à insérer
            $data['image'] = $finalImagePath; // Ajout du chemin de l'image au tableau de données
        } else {
            // Si l'upload échoue, affichez une erreur
            die('Échec de l\'upload de l\'image.');
        }
    } else {
        // Si aucune image n'a été uploadée ou une erreur est survenue
        die('Aucune image uploadée ou une erreur est survenue.');
    }

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
    // Récupérer l'image existante dans la base de données avant de procéder à la mise à jour
    include_once '../app/models/postsModel.php';
    $existingPost = \App\Models\PostsModel\findOneById($connexion, $id);

    // Vérifiez si une nouvelle image a été uploadée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $temporaryImagePath = $_FILES['image']['tmp_name'];
        $uploadedImageName = basename($_FILES['image']['name']);
        $targetUploadDirectory = '../public/images/blog/';
        $finalImagePath = $targetUploadDirectory . $uploadedImageName;

        // Déplacez le fichier uploadé vers le dossier cible
        if (move_uploaded_file($temporaryImagePath, $finalImagePath)) {
            $data['image'] = $finalImagePath; // Utilisez le nouveau chemin d'image
        } else {
            die('Échec de l\'upload de l\'image.');
        }
    } else {
        // Si aucune nouvelle image n'est uploadée, conserver l'image existante
        $data['image'] = $existingPost['image'];
    }

    // Mettez à jour le post avec les nouvelles données
    if (\App\Models\PostsModel\updateOneById($connexion, $id, $data)) {
        header('Location: ' . BASE_PUBLIC_URL);
    } else {
        die('Échec de la mise à jour du post.');
    }
}


function deleteAction(PDO $connexion, int $id)
{
    include_once '../app/models/postsModel.php';
    $return = \App\Models\PostsModel\deleteOneById($connexion, $id);

    header('Location: ' . BASE_PUBLIC_URL);
}
