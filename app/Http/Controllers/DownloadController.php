<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadExcel($filename)
{
    $filePath = storage_path('app/files/' . $filename);

    $allowedFiles = ['Classeur.xlsx'];

    if (!in_array($filename, $allowedFiles)) {
        abort(403, 'Unauthorized file access.');
    }

    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->download($filePath, $filename, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ]);
}
}
