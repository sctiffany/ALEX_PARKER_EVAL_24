<?php

namespace App\Models\PostsModel;

use \PDO;

function findAll(PDO $connexion, int $limit = 10): array
{
    $sql = "SELECT *, p.id AS postID, c.id AS categoryID
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            ORDER BY p.created_at DESC
            LIMIT :limit;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findOneById(PDO $connexion, int $id): array
{
    $sql = "SELECT *, p.id AS postID, c.id AS categoryID, p.created_at AS postCreationDate
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetch(PDO::FETCH_ASSOC);
}

function insertOne(PDO $connexion, array $data = null)
{
    $sql = "INSERT INTO posts
            SET title = :title,
                text = :text,
                created_at = NOW(),
                quote = :quote,
                category_id = :category_id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':title', $data['title'], PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], PDO::PARAM_STR);
    $rs->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
    $rs->execute();
    return $connexion->lastInsertId();
}
