<?php

namespace App\Http\Controllers;

use App\Models\AllergyTest;
use Illuminate\Http\Request;
use App\Exports\AllergyTestExport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function newTest(Request $request, $visit)
    {
        $incomingData = $request->validate([
            'test_date' => ['required', 'date'],
            'test_type' => ['required', 'string', 'max:255'],
            'test_result' => ['required', 'string', 'max:255'],
            'test_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $test = new AllergyTest();
        $test->test_date = $incomingData['test_date'];
        $test->test_type = $incomingData['test_type'];
        $test->test_result = $incomingData['test_result'];
        $test->test_note = $incomingData['test_note'];
        $test->visit_id = $visit;
        $test->save();

        return response()->json(['message' => 'Test created successfully', 'test' => $test, 'id' => $test->id], 201);
    }

    public function editTest(Request $request, AllergyTest $test)
    {
        $incomingData = $request->validate([
            'new_test_date' => ['required', 'date'],
            'new_test_type' => ['required', 'string', 'max:255'],
            'new_test_result' => ['required', 'string', 'max:255'],
            'new_test_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $test->test_date = $incomingData['new_test_date'];
        $test->test_type = $incomingData['new_test_type'];
        $test->test_result = $incomingData['new_test_result'];
        $test->test_note = $incomingData['new_test_note'];
        $test->save();

        return response()->json(['message' => 'Test updated successfully', 'test' => $test], 200);
    }

    public function deleteTest(AllergyTest $test)
    {
        $test->delete();
        return response()->json(['message' => 'Test deleted successfully'], 200);
    }
    public function exportTests(){
        return Excel::download(new AllergyTestExport(), 'patients.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="patients.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'charset' => 'UTF-8',
            'Content-Encoding' => 'UTF-8',
        ]);
    }
}
