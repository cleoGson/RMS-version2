<?php

namespace App\Exports;

use App\Model\Classsetup as Curriculum;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Writer;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\FromView;

class ClassSetup implements FromView,WithEvents
{

      protected $classsetup;

    public function __construct(object $classsetup)
    {
        $this->classsetup = $classsetup;
    }

    public function object(): object
    {
        return $this->classsetup;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('academics.classsetups.download', [
            'show' =>$this->classsetup 
        ]);
    }

     /**
     * @return array
     */
    public function registerEvents(): array
    {

Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);

});

Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
    $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
});
Writer::macro('setCreator', function (Writer $writer, string $creator) {
    $writer->getDelegate()->getProperties()->setCreator($creator);
});
return [
              BeforeExport::class  => function(BeforeExport $event) {
                $event->writer->setCreator('RMS_Generator');
            },
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->styleCells(
                    'A1:Z8',
                    [
                        'borders' => [
                            'outline' => [
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ]
                    ]
                );
            },
        ];
    }

    
}
