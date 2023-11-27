<?php

namespace App\Console\Commands;

use App\Exports\Workbook;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Command\Command as CommandAlias;

class WorkbookExport extends Command
{
    protected $signature = 'workbook:export
        {--sheets=5 : The amount of sheets per workbook}
        {--rows=1000 : The amount of rows per sheet}
        {--columns=26 : The amount of columns per sheet}
    ';

    protected $description = 'Test generation of queued excel exports';

    public function handle(): int
    {
        $this->truncateJobs();

        $this->createWorkbook();

        return CommandAlias::SUCCESS;
    }

    private function truncateJobs(): void
    {
        DB::table('failed_jobs')->truncate();
        DB::table('jobs')->truncate();
    }

    private function createWorkbook(): void
    {
        $workBook = new Workbook($this->option('sheets'), $this->option('rows'), $this->option('columns'));

        Excel::queue($workBook, $workBook->fileName());
    }

}
