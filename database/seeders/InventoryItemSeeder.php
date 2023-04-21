<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fp = fopen(__DIR__ . "/data/inventory.csv", "r");
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
        
            InventoryItem::create($data);

            $rows++;
        }
        echo "$rows inventory records cresated. \n";
    }
}
