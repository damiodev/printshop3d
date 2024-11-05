<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Address, Country, Product, Colissimo, Range, State, Shop, Page, Order};
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insérer les pays
        Country::insert([
            ['name' => 'France', 'tax' => 0.2],
            ['name' => 'Belgique', 'tax' => 0.2],
            ['name' => 'Suisse', 'tax' => 0],
            ['name' => 'Canada', 'tax' => 0],
        ]);

        // Insérer les plages de poids
        Range::insert([
            ['max' => 1],
            ['max' => 2],
            ['max' => 3],
            ['max' => 100],
        ]);

        // Insérer les tarifs de Colissimo
        Colissimo::insert([
            ['country_id' => 1, 'range_id' => 1, 'price' => 7.25],
            ['country_id' => 1, 'range_id' => 2, 'price' => 8.95],
            ['country_id' => 1, 'range_id' => 3, 'price' => 13.75],
            ['country_id' => 1, 'range_id' => 4, 'price' => 0],
            ['country_id' => 2, 'range_id' => 1, 'price' => 15.5],
            ['country_id' => 2, 'range_id' => 2, 'price' => 17.55],
            ['country_id' => 2, 'range_id' => 3, 'price' => 22.45],
            ['country_id' => 2, 'range_id' => 4, 'price' => 0],
            ['country_id' => 3, 'range_id' => 1, 'price' => 15.5],
            ['country_id' => 3, 'range_id' => 2, 'price' => 17.55],
            ['country_id' => 3, 'range_id' => 3, 'price' => 22.45],
            ['country_id' => 3, 'range_id' => 4, 'price' => 0],
            ['country_id' => 4, 'range_id' => 1, 'price' => 27.65],
            ['country_id' => 4, 'range_id' => 2, 'price' => 38],
            ['country_id' => 4, 'range_id' => 3, 'price' => 55.65],
            ['country_id' => 4, 'range_id' => 4, 'price' => 0],
        ]);

        // Insérer les états des commandes
        State::insert([
            ['name' => 'Attente chèque', 'slug' => 'cheque', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Attente mandat administratif', 'slug' => 'mandat', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Attente virement', 'slug' => 'virement', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Attente paiement par carte', 'slug' => 'carte', 'color' => 'blue', 'indice' => 1],
            ['name' => 'Erreur de paiement', 'slug' => 'erreur', 'color' => 'red', 'indice' => 0],
            ['name' => 'Annulé', 'slug' => 'annule', 'color' => 'red', 'indice' => 2],
            ['name' => 'Mandat administratif reçu', 'slug' => 'mandat_ok', 'color' => 'green', 'indice' => 3],
            ['name' => 'Paiement accepté', 'slug' => 'paiement_ok', 'color' => 'green', 'indice' => 4],
            ['name' => 'Expédié', 'slug' => 'expedie', 'color' => 'green', 'indice' => 5],
            ['name' => 'Remboursé', 'slug' => 'rembourse', 'color' => 'red', 'indice' => 6],
        ]);

        // Créer des utilisateurs et des adresses
        User::factory()
            ->count(20)
            ->create()
            ->each(function ($user) {
                $user->addresses()->createMany(
                    Address::factory()
                        ->count(mt_rand(2, 3)) // Créer 2 à 3 adresses pour chaque utilisateur
                        ->make()
                        ->toArray()
                );
            });

        // Définir le premier utilisateur comme admin
        $user = User::find(1);
        $user->admin = true;
        $user->save();

        // Créer des produits
        Product::factory()->count(6)->create();

        // Créer des pages
        $items = [
            ['livraisons', 'Livraisons'],
            ['mentions-legales', 'Mentions légales'],
            ['conditions-generales-de-vente', 'Conditons générales de vente'],
            ['politique-de-confidentialite', 'Politique de confidentialité'],
            ['respect-environnement', 'Respect de l\'environnement'],
            ['mandat-administratif', 'Mandat administratif'],
        ];

        foreach ($items as $item) {
            Page::factory()->create([
                'slug' => $item[0],
                'title' => $item[1],
            ]);
        }

        // Créer des commandes
        Order::factory()
            ->count(30)
            ->create()
            ->each(function ($order) {
                $addresses = $order->user->addresses()->take(1)->get()->makeHidden(['id', 'user_id'])->toArray();

                // Vérifier si des adresses existent
                if (!empty($addresses)) {
                    $order->adresses()->create($addresses[0]);

                    if (mt_rand(0, 1)) {
                        $addresses = $order->user->addresses()->skip(1)->take(1)->get()->makeHidden(['id', 'user_id'])->toArray();

                        if (!empty($addresses)) {
                            $addresses[0]['facturation'] = false;
                            $order->adresses()->create($addresses[0]);
                        }
                    }

                    // Traiter les produits et les paiements
                    $countryId = $addresses[0]['country_id'];
                    $total = 0;

                    // Sélectionner un produit aléatoire
                    $product = Product::inRandomOrder()->first();
                    $quantity = mt_rand(1, 3);
                    $price = $product->price * $quantity;
                    $total = $price;

                    // Créer la ligne de produit
                    $order->products()->create([
                        'name' => $product->name,
                        'total_price_gross' => $price,
                        'quantity' => $quantity,
                    ]);

                    if (mt_rand(0, 1)) {
                        $product = Product::inRandomOrder()->first();
                        $quantity = mt_rand(1, 3);
                        $price = $product->price * $quantity;
                        $total += $price;

                        $order->products()->create([
                            'name' => $product->name,
                            'total_price_gross' => $price,
                            'quantity' => $quantity,
                        ]);
                    }

                    // Gestion des informations de paiement
                    if ($order->payment === 'carte' && $order->state_id === 8) {
                        $order->payment_infos()->create(['payment_id' => (string) Str::uuid()]);
                    }

                    $order->tax = $countryId > 2 ? 0 : .2;
                    $order->total = $total;
                    $order->save();
                }
            });
    }
}
