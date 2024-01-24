<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CSVController extends Controller
{
    public function import(Request $request)
    {
        $base64Data = $request->input('csv_data');

        $csvData = base64_decode($base64Data);

        //$filename = 'archivo.csv';
        //file_put_contents($temp, $csvData);

        $temp = tempnam(sys_get_temp_dir(), 'csv_import');
        file_put_contents($temp, $csvData);

        try {
            Excel::import(new UserImport, $temp);
            unlink($temp);

            return response()->json(['message' => 'Importación exitosa']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error en la importación: ' . $e->getMessage()], 500);
        }
    }
}
