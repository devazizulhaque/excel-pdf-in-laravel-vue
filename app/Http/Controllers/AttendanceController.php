<?php

namespace App\Http\Controllers;

use App\Imports\ImportAttendance;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendance = Attendance::all();
        return response()->json($attendance);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('excelfile')) {
            $file = $request->file('excelfile');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName);

            $import = new ImportAttendance();
            Excel::import($import, $file);

            return response()->json(['message' => 'File uploaded and data saved successfully']);
        }
        return response()->json(['message' => 'No file uploaded'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function attendancepdf(Request $request)
    {
        $attendances = json_decode($request->input('attendance'), true);

        // Generate PDF using library (e.g., dompdf)
        $pdf = PDF::loadView('attendance.pdf', ['attendances' => $attendances]);

        // Save the PDF file or return it as a response
        return $pdf->download('generated_pdf.pdf');
    }
}
