<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Exports\ExamExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function newExam(Request $request, $visit)
    {
        $incomingData = $request->validate([
            'exam_date' => ['required', 'date'],
            'exam_type' => ['required', 'string', 'max:255'],
            'exam_result' => ['required', 'string', 'max:255'],
            'exam_note' => ['nullable', 'string', 'max:1000'],
            'exam_file' => ['nullable', 'file', 'mimes:pdf,jpeg,jpg,png,gif,bmp,svg,webp'],
        ]);

        $exam = new Exam();
        $exam->date = $incomingData['exam_date'];
        $exam->type = $incomingData['exam_type'];
        $exam->result = $incomingData['exam_result'];
        $exam->note = $incomingData['exam_note'];
        $exam->visit_id = $visit;

        if ($request->hasFile('exam_file')) {
            $exam->file = file_get_contents($request->file('exam_file')->getRealPath());
            $exam->file_mime = $request->file('exam_file')->getMimeType();
        }

        $exam->save();

        return response()->json([
            'message' => 'Exam created successfully',
            'exam' => $exam,
            'id' => $exam->id,
            'has_file' => ($exam->file ? true : false),
        ], 201);
    }

    public function editExam(Request $request, Exam $exam)
    {
        $incomingData = $request->validate([
            'new_exam_date' => ['required', 'date'],
            'new_exam_type' => ['required', 'string', 'max:255'],
            'new_exam_result' => ['required', 'string', 'max:255'],
            'new_exam_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $exam->date = $incomingData['new_exam_date'];
        $exam->type = $incomingData['new_exam_type'];
        $exam->result = $incomingData['new_exam_result'];
        $exam->note = $incomingData['new_exam_note'];
        $exam->save();

        return response()->json(['message' => 'Exam updated successfully', 'exam' => $exam], 200);
    }

    public function deleteExam(Exam $exam)
    {
        $exam->delete();
        return response()->json(['message' => 'Exam deleted successfully'], 200);
    }
    
    public function exportExams(){
        return Excel::download(new ExamExport(), 'exams.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="exams.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'charset' => 'UTF-8',
            'Content-Encoding' => 'UTF-8',
        ]);
    }

    // file management
    public function viewExamFile(Exam $exam)
    {
        if (!$exam->file) {
            return response()->json(['message' => 'No file found'], 404);
        }

        // create the packet to view the file on another web page ('target' attribute into the blade)
        return response($exam->file)
            ->header('Content-Type', $exam->file_mime)
            ->header('Content-Disposition', 'inline; filename="exam_file_' . $exam->id . '"');
    }

    public function uploadExamFile(Request $request, Exam $exam)
    {
        $request->validate([
            'exam_file' => ['required', 'file', 'mimes:pdf,jpeg,jpg,png,gif,bmp,svg,webp'],
        ]);

        if ($exam->file) {
            return response()->json(['message' => 'File already exists. Use replace instead.'], 400);
        }

        $exam->file = file_get_contents($request->file('exam_file')->getRealPath());
        $exam->file_mime = $request->file('exam_file')->getMimeType();
        $exam->save();

        return response()->json(['message' => 'File uploaded successfully'], 200);
    }

    public function replaceExamFile(Request $request, Exam $exam)
    {
        $request->validate([
            'exam_file' => ['required', 'file', 'mimes:pdf,jpeg,jpg,png,gif,bmp,svg,webp'],
        ]);

        $exam->file = file_get_contents($request->file('exam_file')->getRealPath());
        $exam->file_mime = $request->file('exam_file')->getMimeType();
        $exam->save();

        return response()->json(['message' => 'File replaced successfully'], 200);
    }

    public function deleteExamFile(Exam $exam)
    {
        $exam->file = null;
        $exam->file_mime = null;
        $exam->save();

        return response()->json(['message' => 'File deleted successfully'], 200);
    }
}