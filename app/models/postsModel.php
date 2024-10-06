<?php

namespace App\Models\PostsModel;

use \PDO;

function findAll(PDO $connexion, int $limit = 3, int $offset = 0): array
{
    $sql = "SELECT *, p.id AS postID, c.id AS categoryID, p.created_at AS postCreationDate
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            ORDER BY p.created_at DESC
            LIMIT :limit 
            OFFSET :offset;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->bindValue(':offset', $offset, PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function countAll(PDO $connexion): int
{
    $sql = "SELECT COUNT(*) AS total FROM posts;";
    $rs = $connexion->query($sql);
    return $rs->fetch(PDO::FETCH_ASSOC)['total'];
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

function insertOne(PDO $connexion, array $data = null): int
{
    $sql = "INSERT INTO posts
            SET title = :title,
                text = :text,
                image = :image,
                created_at = NOW(),
                quote = :quote,
                category_id = :category_id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':title', $data['title'], PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], PDO::PARAM_STR);
    $rs->bindValue(':image', $data['image'], PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], PDO::PARAM_STR);
    $rs->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
    $rs->execute();
    return $connexion->lastInsertId();
}


function updateOneById(PDO $connexion, int $id, array $data = null): bool
{
    $sql = "UPDATE posts
            SET title = :title,
                text = :text,
                image = :image,
                quote = :quote,
                category_id = :category_id
            WHERE id = :id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':title', $data['title'], PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], PDO::PARAM_STR);
    $rs->bindValue(':image', $data['image'], PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], PDO::PARAM_STR);
    $rs->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    return $rs->execute();
}

function deleteOneById(PDO $connexion, int $id): bool
{
    $sql = "DELETE FROM posts
            WHERE id = :id;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    return intval($rs->execute());
    // intval = forcer une réponse en booléen
}
