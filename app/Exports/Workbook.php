<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

readonly class Workbook implements WithMultipleSheets
{
    public function __construct(protected int $numberOfSheets = 1, protected int $numberOfRows = 100, protected int $numberOfColumns = 10) { }

    public function sheets(): array
    {
        $sheets = [];

        for ($i = 0; $i < $this->numberOfSheets; $i++) {
            $sheets[] = new Sheet($i + 1, $this->numberOfRows, $this->numberOfColumns);
        }

        return $sheets;
    }

    public function fileName(): string
    {
        return time() . '-' . $this->numberOfSheets . '-' . $this->numberOfRows . '-' . $this->numberOfColumns . '.xlsx';
    }
}
