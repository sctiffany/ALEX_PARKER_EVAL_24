<?php

use App\Controllers\PostsController;

include '../app/controllers/postsController.php';

// Si on passe par ici, on est certains qu'il existe
switch ($_GET['posts']):
    case 'show':
        //PATTERN: /posts/id/slug-du-post.html
        //URL: index.php?posts=show&id=xxx
        //CTRL: postsController
        //ACTION: show
        //TITLE: Alex Parker - Title du post
        PostsController\showAction($connexion, $_GET['id']);
        break;

    case 'addForm':
        //PATTERN: posts/add/form.html
        //URL: index.php?posts=addForm
        //CTRL: postsController
        //ACTION: addForm
        //TITLE: Alex Parker - Add a post
        PostsController\addFormAction($connexion);
        break;

    case 'addInsert':
        //PATTERN: posts/add/insert.html
        //URL: index.php?posts=addInsert
        //CTRL: postsController
        //ACTION: addInsert
        //TITLE: Redirection page accueil
        PostsController\addInsertAction($connexion, [
            'title' => $_POST['title'],
            'text' => $_POST['text'],
            'quote' => $_POST['quote'],
            'category_id' => $_POST['category_id'],
        ]);
        break;

    case 'editForm':
        //PATTERN: /posts/id/slug-du-post/edit/form.html
        //URL: index.php?posts=editForm&id=x
        //CTRL: postsController
        //ACTION: editForm
        //TITLE: Alex Parker - Edit a post
        PostsController\editFormAction($connexion, $_GET['id']);
        break;

    case 'editUpdate':
        //PATTERN: /posts/id/slug-du-post/edit/update.html
        //URL: index.php?posts=editUpdate&id=x
        //CTRL: postsController
        //ACTION: editUpdate
        //TITLE: Redirection page accueil
        PostsController\editUpdateAction($connexion, $_GET['id'], $_POST);
        break;

    case 'delete':
        PostsController\deleteAction($connexion, $_GET['id']);
        break;

    case 'page':
        // PATTERN: /posts/page/x
        // URL: index.php?posts=page&page=x
        // CTRL: postsController
        // ACTION: index (pour afficher la page x des posts)
        PostsController\indexAction($connexion, $_GET['page']);
        break;
endswitch;
