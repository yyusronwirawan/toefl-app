<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam\Answer;
use App\Models\Exam\Exam;
use App\Models\Exam\ValueCategoryExam;
use App\Models\Lesson\{DetailValueCategory, ValueCategory};
use App\Models\Exam\GradeDetail;
use App\Models\Exam\Grade;
use DB;
use Ramsey\Uuid\Uuid as Generator;
use Carbon\Carbon;
use App\Models\Lesson\Question;
use App\Models\Transaction\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class TestingController extends Controller
{
    public function index()
    {

        $data = Grade::find('26c56bc2-35c3-4db6-a2af-edceb6ae4fe1');

        $replacement = [
            "{testing}" => 'dede'
        ];

        

        return $replacement;

        $pdf = Pdf::loadView('certificate.certificate_sample')->setPaper('a4', 'landscape');
        // $pdf = Pdf::loadView('certificate.certificate_sample');
        return $pdf->stream('invoice.pdf');
    }

    public function checkConnection()
    {
        try {
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function onprogress()
    {
        return inertia('OnProgress/OnProgress');
    }
}
