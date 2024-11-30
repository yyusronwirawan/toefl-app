<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam\Grade;
use Auth;
use Carbon\Carbon;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Exam\GradeRepository;
use App\Repositories\MasterData\AnnouncementRepository;
use App\Repositories\MasterData\CategoryRepository;
use App\Models\Setting;

class DashboardController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository, )
    {
        $this->transactionRepository = $transactionRepository;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return inertia('User/Dashboard/Index', [
            'totalTransactionPending' => number_format($this->transactionRepository->getTotalTransactionPendingByUser()),
            'totalTransactionPaid' => number_format($this->transactionRepository->getTotalTransactionPaidByUser()),
            'totalTransactionDone' => number_format($this->transactionRepository->getTotalTransactionDoneByUser()),
            'totalTransactionFailed' => number_format($this->transactionRepository->getTotalTransactionFailedByUser()),

            'transactionSummaries' =>  $this->transactionRepository->getSummaryTransactionByUser(),
            'announcementSummaries' =>  (new announcementRepository())->getAnnouncementSummaries(),
        ]);
    }
}
