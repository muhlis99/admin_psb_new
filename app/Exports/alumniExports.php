<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class alumniExports implements FromView,ShouldAutoSize
{   
    use Exportable;
    
    public function view():View
    {
        return view('admin.alumni.alumni_export');
    }
}