<?php

namespace App\Exports;

use App\Models\Lesson as ModelsLesson;
use App\Models\State;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
// used for autosizing columns
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Lesson implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ModelsLesson::all();
    }

    public function map($lesson): array
    {
        return [

            $lesson->title,
            $lesson->slug,
            $lesson->image,
            ($lesson->status == 1) ? 'Active' : 'Inactive',
            $lesson->created_at,
        ];
    }

    public function headings(): array
    {
        return ['Title', 'Slug', 'Image', 'Status', 'Created at'];
    }
}
