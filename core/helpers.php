<?php

namespace Core\Helpers;

function truncate(string $string, int $lg_max = 100): string
{
    if (strlen($string) > $lg_max) {
        $string = substr($string, 0, $lg_max);
        $last_space = strrpos($string, " ");
        return substr($string, 0, $last_space) . "...";
    }
    return $string;
}

function formatDate(string $date): string
{
    // Convertir la date en timestamp
    $timestamp = strtotime($date);

    // Retourner la date au format 'Y-m-d'
    return date('Y-m-d', $timestamp);
}
