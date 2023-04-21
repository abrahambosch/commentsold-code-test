<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fp = fopen(__DIR__ . "/data/products.csv", "r");
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
        
            Product::create($data);

            $rows++;
        }
        $this->command->info("$rows product records cresated. ");
    }
}
