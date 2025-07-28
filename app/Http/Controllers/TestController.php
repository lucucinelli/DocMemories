<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function newTest(Request $request, $visit)
    {
        // Logic to create a new test for the visit
    }

    public function editTest(Request $request, $test)
    {
        // Logic to edit an existing test
    }

    public function deleteTest($test)
    {
        // Logic to delete an existing test
    }
}
