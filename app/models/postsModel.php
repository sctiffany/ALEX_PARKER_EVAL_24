<?php

namespace App\Models\PostsModel;

use \PDO;

function findAll(PDO $connexion, int $limit = 10): array
{
    $sql = "SELECT *
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            ORDER BY p.created_at DESC
            LIMIT :limit;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
