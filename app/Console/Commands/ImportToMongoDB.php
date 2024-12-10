<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use MongoDB\Laravel\Eloquent\Model;

class ImportToMongoDB extends Command
{
    protected $signature = 'data:import-mongodb';
    protected $description = 'Import data from JSON files to MongoDB';

    public function handle()
    {
        $path = storage_path('app/mysql_backup');
        $tables = ['addresses', 'orders', 'order_items'];

        foreach ($tables as $table) {
            $jsonFile = $path . '/' . $table . '.json';
            if (!file_exists($jsonFile)) {
                $this->error("File not found: {$jsonFile}");
                continue;
            }

            $data = json_decode(file_get_contents($jsonFile), true);
            
            switch ($table) {
                case 'addresses':
                    foreach ($data as $item) {
                        Address::create((array)$item);
                    }
                    break;
                case 'orders':
                    foreach ($data as $item) {
                        Order::create((array)$item);
                    }
                    break;
                case 'order_items':
                    foreach ($data as $item) {
                        OrderItem::create((array)$item);
                    }
                    break;
            }
            
            $this->info("Imported data into {$table} collection");
        }

        $this->info('All data imported successfully!');
    }
}
