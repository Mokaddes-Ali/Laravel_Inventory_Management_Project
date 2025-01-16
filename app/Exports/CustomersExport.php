<?php

// namespace App\Exports;

// use App\Models\Customer;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class CustomersExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection(array $row)
//     {
//         return new Customer([
//             'name'  => $row['name'],
//             'email' => $row['email'],
//             'phone' => $row['phone'],
//             'address' => $row['address'],

//         ]);
//     }
// }



// namespace App\Exports;

// use App\Models\Customer;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class CustomersExport implements FromCollection, WithHeadings
// {
//     /**
//      * এক্সেল ডেটার জন্য Collection ফেরত দিবে।
//      *
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         return Customer::select('name', 'email', 'number', 'address')->get();
//     }

//     /**
//      * এক্সেলের শিরোনাম কলাম সেট করে।
//      *
//      * @return array
//      */
//     public function headings(): array
//     {
//         return [
//             'Name',
//             'Email',
//             'number',
//             'Address',
//         ];
//     }
// }




namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;

class CustomersExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents
{
    /**
     * এক্সেল ডেটার জন্য Collection ফেরত দিবে।
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::select('name', 'email', 'number', 'address')->get();
    }

    /**
     * এক্সেলের শিরোনাম কলাম সেট করে।
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Number',
            'Address',
        ];
    }

    /**
     * এক্সেল ফাইলের কলামের প্রস্থ (width) সেট করা।
     *
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 15,
            'D' => 30,
        ];
    }

    /**
     * এক্সেল ফাইলের স্টাইল সেট করা।
     *
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // শিরোনাম কলামের ফন্ট বড় এবং বোল্ড করা
            1 => ['font' => ['bold' => true, 'size' => 12]],

            // সমস্ত কলামের টেক্সট সেন্টার করা
            'A:D' => ['alignment' => ['horizontal' => 'center']],
        ];
    }

    /**
     * ইভেন্ট হ্যান্ডলার যোগ করা (Row Height & Auto Size)
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                // প্রতিটি রো-এর উচ্চতা সেট করা (padding-এর মতো)
                for ($i = 1; $i <= 100; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(25);
                }

                // কলামের টেক্সট অটো-সাইজ করা
                foreach (range('A', 'D') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
