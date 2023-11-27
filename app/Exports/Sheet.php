<?php

namespace App\Exports;

use Generator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

readonly class Sheet implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(protected int $sheetNumber = 1, protected int $numberOfRows = 100, protected int $numberOfColumns = 26) { }

    public function title(): string
    {
        return "Sheet {$this->sheetNumber}";
    }

    public function headings(): array
    {
        $headings = [];

        for ($i = 0; $i <= $this->numberOfColumns; $i++) {
            $headings[] = "Heading {$this->sheetNumber} - {$i}";
        }

        return $headings;
    }

    public function generator(): Generator
    {
        for ($i = 0; $i <= $this->numberOfRows; $i++) {
            yield range(0, $this->numberOfColumns);
        }
    }

    public function collection(): Collection
    {
        return collect($this->array());
    }

    public function array(): array
    {
        $array = [];

        for ($i = 0; $i <= $this->numberOfRows; $i++) {
            for ($j = 0; $j <= $this->numberOfColumns; $j++) {
                $array[$i][$j] = "CS {$this->sheetNumber} {$j}";
            }
        }

        return $array;
    }
}
