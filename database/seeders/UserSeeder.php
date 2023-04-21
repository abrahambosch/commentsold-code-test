<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /*
        CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `superadmin` tinyint(1) NOT NULL,
  `shop_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_brand` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `shop_domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `billing_plan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trial_starts_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci |

    */


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fp = fopen(__DIR__ . "/data/users.csv", "r");
        if (!$fp) {
            throw new \Exception("Error openeing users.cev file");
        }
        $header = fgetcsv($fp, 5000, ",");
        $rows = 0; 
        while (($row = fgetcsv($fp, 5000, ",")) !== FALSE)
        {
            $data = [];
            foreach ($header as $i => $name) {
                $data[$name] = $row[$i] ?? null;
            }
        
            User::create([
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password_hash'],
                'superadmin' => (bool) $data['superadmin'],
                'shop_name' => $data['shop_name'],
                'remember_token' => $data['remember_token'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
                'card_brand' => $data['card_brand'],
                'card_last_four' => $data['card_last_four'],
                'trial_ends_at' => $data['trial_ends_at'],
                'shop_domain' => $data['shop_domain'],
                'is_enabled' => (bool) $data['is_enabled'],
                'billing_plan' => $data['billing_plan'],
                'trial_starts_at' => $data['trial_starts_at'],
            ]);

            $rows++;
        }
        $this->command->info("$rows user records cresated. ");
    }
}
