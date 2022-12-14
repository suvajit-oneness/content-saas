<?php

namespace App\Exports;

use App\Models\ArticleCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArticleCategoryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ArticleCategory::all();
    }

    public function map($categories): array
    {
        return [
            $categories->title,
            $categories->description,
            ($categories->status == 1) ? 'Active' : 'Pending',
            $categories->created_at,
        ];
    }

    public function headings(): array
    {
        return ['Title', 'Description', 'Status', 'Created at'];
    }

}

