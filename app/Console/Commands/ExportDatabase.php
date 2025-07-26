<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ExportDatabase extends Command
{
    protected $signature = 'db:export {file?}';
    protected $description = 'Exports the database to a .sql file';

    public function handle()
    {
        // your logic here
    }
}
