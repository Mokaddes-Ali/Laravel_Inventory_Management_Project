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
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::select('id','name', 'email', 'number', 'address','slug')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Number',
            'Address',
            'Slug',
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 20,
            'F' => 15,
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 10]],

            'A:F' => ['alignment' => ['horizontal' => 'center']],
            'A:F' => ['alignment' => ['vertical' =>'center']],
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


                for ($i = 1; $i <= 100; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(20);
                }

                // কলামের টেক্সট অটো-সাইজ করা
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
