<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ExportMySQLData extends Command
{
    protected $signature = 'data:export-mysql';
    protected $description = 'Export data from MySQL tables to JSON files';

    public function handle()
    {
        $tables = ['addresses', 'orders', 'order_items'];
        $path = storage_path('app/mysql_backup');
        
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        foreach ($tables as $table) {
            $data = DB::table($table)->get();
            file_put_contents(
                $path . '/' . $table . '.json',
                json_encode($data, JSON_PRETTY_PRINT)
            );
            $this->info("Exported {$table} data to {$table}.json");
        }

        $this->info('All data exported successfully!');
    }
}
