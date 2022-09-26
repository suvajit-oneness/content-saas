<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourseExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Course::all();
    }

    public function map($categories): array
    {
        return [

            $categories->course_name,
            $categories->short_description,
            $categories->description,
            ($categories->category? $categories->category->title : ''),
            $categories->company_name,
            $categories->company_description,
            $categories->author_name,
            $categories->author_description,
            $categories->target,
            $categories->requirements,
            $categories->language,
            $categories->type,
            $categories->price,
            ($categories->status == 1) ? 'Active' : 'Inactive',
            $categories->created_at,
        ];
    }

    public function headings(): array
    {
        return ['Course', 'Short Description','Description', 'Category','Company Name','Company Description','Author Name','Author Description','Target','Language','Requirements','Type','Price','Status','Created at'];
    }

}

