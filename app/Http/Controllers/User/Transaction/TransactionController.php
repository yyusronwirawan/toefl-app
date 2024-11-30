<?php

namespace App\Http\Controllers\User\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Transaction\BankRepository;
use App\Repositories\Exam\ExamRepository;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('User/Transaction/Transaction/Index', [
            'transactions' => $this->transactionRepository->getAllPaginatedWithParamsByUser($request)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->transactionRepository->find($id)) return abort('404', 'uppss....');

        return inertia('User/Transaction/Transaction/Show', [
            'transaction' => $this->transactionRepository->find($id),
            'banks' => (new BankRepository())->all()
        ]);
    }

    public function buy(Request $request, $id)
    {
        try {
            $exam = (new ExamRepository())->find($id);

            if(!$exam) return abort('404', 'uppss....');

            if($this->transactionRepository->checkTransactionPendingByUser()) {
                return redirect()->route('user.categories.exams.index', $exam->category_id)->with('error', 'Anda memiliki transaksi yang terpending, silakan selesaikan terlebih dahulu transaksi tersebut atau silakan hubungi admin');
            }

            $transaction = $this->transactionRepository->createTransacationWithExamId($id);

            return redirect()->route('user.transactions.show', $transaction->id);

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. '.$e->getMessage().' - file: '. $e->getFile(). ' -line '. $e->getLine());
        }
    }
}
