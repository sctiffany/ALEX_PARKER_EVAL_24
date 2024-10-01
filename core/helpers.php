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

function formatDatetoEntireDate(string $date): string
{
    // Convertir la date en timestamp
    $timestamp = strtotime($date);

    // Retourner la date au format 'Y-m-d'
    return date('F j, Y', $timestamp);
}

function slugify(string $string): string
{
    // Strip html tags
    $string = strip_tags($string);
    // Replace non letter or digits by -
    $string = preg_replace('~[^\pL\d]+~u', '-', $string);
    // Transliterate
    setlocale(LC_ALL, 'en_US.utf8');
    $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
    // Remove unwanted characters
    $string = preg_replace('~[^-\w]+~', '', $string);
    // Trim
    $string = trim($string, '-');
    // Remove duplicate -
    $string = preg_replace('~-+~', '-', $string);
    // Lowercase
    $string = strtolower($string);
    // Check if it is empty
    if (empty($string)) {
        return 'n-a';
    }
    // Return result
    return $string;
}
