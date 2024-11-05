<?php

use App\Models\Page;
use Faker\Generator as Faker;

/**
 * Generate fake data for the `pages` table.
 * Génère des données factices pour la table `pages`.
 */
$factory->define(Page::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph(10),
    ];
});