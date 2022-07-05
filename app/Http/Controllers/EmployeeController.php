<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeBulkImport;
use App\Imports\UsersImport;
use App\Models\Employee;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class EmployeeController extends Controller
{
   // Upload XL File
   public function fileUpload(Request $request){

    if (!empty($request->file('file'))) {
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
    }
    
    return response()->json([
        'message' => 'Done',
        'Data'  => $request->dummy,
        'files' => $request->file('file')->getClientOriginalExtension()
    ],201);
   }

   // Get All Employee Data 

   public function employeeList(Request $request){


      $searchingData=request()->search;

       if( $searchingData != null  ){
        $searchingData=request()->search;
        $employeeList=Employee::where('employee_id', $searchingData)->get();
        return response()->json($employeeList);
     }else{
        $employeeList=Employee::orderBy('id', 'DESC')->get();
        return response()->json($employeeList);
     }

   }



   // Generate Report PDF
   public function generatePdf()
   { 

    $employeeList=Employee::orderBy('id', 'DESC')->get();
   $pdf = PDF::loadView('employeePDF',compact('employeeList'));
    //    return $this->output($pdf);
  
   return $pdf->stream();

    // $mpdf = new \Mpdf\Mpdf([
    //     'default_font' => 'ayar',
    //     'mode' => 'utf-8',
    //     'tempDir' => storage_path('temp')
    // ]);
    // $mpdf->allow_charset_conversion = true;
    // $mpdf->autoScriptToLang = true;
    // $mpdf->autoLangToFont = true;
    // $mpdf->WriteHTML($employeeList);
    // $mpdf->Output();


   }
}
