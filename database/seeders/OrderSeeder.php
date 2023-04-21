<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fp = fopen(__DIR__ . "/data/orders.csv", "r");
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
            $integers = ['payment_amt_cents', 'ship_charged_cents', 'ship_cost_cents', 'subtotal_cents', 'total_cents', 'tax_total_cents'];
            foreach ($integers as $name) {
                $data[$name] = $this->formatInteger($data[$name]);
            }
            
            Order::create($data);
            
            $rows++;
        }
        $this->command->info("$rows order records cresated. ");
    }

    /**
     * Cast the value to an integer. 
     * The CSV files fometimes have the string 'NULL'. Transform string NULL to 0
     */
    protected function formatInteger($val, $default=0)
    {
        if ($val === 'NULL') {
            $val = $default;
        }
        return (int) $val;
    }

}
