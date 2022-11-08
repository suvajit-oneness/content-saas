<?php

namespace App\Exports;

use App\Models\CourseModule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CourseModuleExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CourseModule::all();
    }

    public function map($categories): array
    {
        return [
            $categories->title,
            $categories->description,
            $categories->course->course_name ?? '',
            ($categories->status == 1) ? 'Active' : 'Pending',
            $categories->created_at,
        ];
    }

    public function headings(): array
    {
        return ['Title', 'Description', 'Status', 'Created at'];
    }

}

