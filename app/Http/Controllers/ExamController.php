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
        ]);

        $exam = new Exam();
        $exam->date = $incomingData['exam_date'];
        $exam->type = $incomingData['exam_type'];
        $exam->result = $incomingData['exam_result'];
        $exam->note = $incomingData['exam_note'];
        $exam->visit_id = $visit;
        $exam->save();

        return response()->json(['message' => 'Exam created successfully', 'exam' => $exam, 'id' => $exam->id], 201);
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
}
