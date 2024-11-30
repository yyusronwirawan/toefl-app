<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Transaction\TransactionInterface;
use App\Repositories\BaseRepository;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\Exam\Exam;
use Illuminate\Support\Str;

class TransactionRepository extends BaseRepository implements TransactionInterface
{
    /**
     * @var
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Transaction();
    }

    public function getAllSimplePaginatedWithParams($params, $limit = 10)
    {
        $transactions = $this->model->query();
        if(isset($params->search) && !empty($params->search)) $transactions->where('code', 'like', '%' . $params->search . '%');
        $transactions = $transactions->orderBy('created_at', 'DESC')->simplePaginate($limit);
        return $transactions;
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $transactions = $this->model->query();
        if(isset($params->search) && !empty($params->search)) $transactions->where('code', 'like', '%' . $params->search . '%');
        $transactions = $transactions->with(['user', 'exam', 'exam.category'])->orderBy('created_at', 'ASC')->paginate($limit);
        return $transactions;
    }

    public function getTransactionMonthly($limit = 10)
    {
        $transactions = $this->model->whereMonth('created_at', Carbon::now()->format('m'))->whereYear('created_at', Carbon::now()->format('Y'))->with(['user', 'exam', 'exam.category'])->orderBy('created_at', 'DESC')->paginate($limit);
        return $transactions;
    }

    public function find($id)
    {
        return $this->model->with(['exam','user', 'exam.category', 'user.student', 'user.student.province', 'user.student.city', 'user.student.district', 'user.student.village'])->find($id);
    }

    public function getAllPaginatedWithParamsByUser($params, $limit = 10)
    {
        $transactions = $this->model;
        if(isset($params->search) && !empty($params->search)) $transactions->where('code', 'like', '%' . $params->search . '%');
        $transactions = $transactions->with(['user', 'exam.category'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate($limit);
        return $transactions;
    }

    public function getAllVoucherActivatedPaginatedWithParamsByUser($params, $limit = 10)
    {
        $transactions = $this->model;
        if(isset($params->search) && !empty($params->search)) $transactions->where('code', 'like', '%' . $params->search . '%');
        $transactions = $transactions->with(['exam', 'exam.category'])->where('voucher_activated', 1)->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate($limit);
        return $transactions;
    }

    public function getSummaryTransactionByUser($limit = 5)
    {
        $transactions = $this->model;
        $transactions = $transactions->with(['exam', 'exam.category'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->limit($limit)->get();
        return $transactions;
    }

    public function getTotalTransactionToday()
    {
        return $this->model->whereDate('created_at', Carbon::now())->count();
    }

    public function getTotalTransactionMonthly()
    {
        return $this->model->whereMonth('created_at', Carbon::now()->format('m'))->whereYear('created_at', Carbon::now()->format('Y'))->count();
    }

    public function getTotalTransactionYearly()
    {
        return $this->model->whereYear('created_at', Carbon::now()->format('Y'))->count();
    }

    public function getTotalTransactionPending()
    {
        return $this->model->where('transaction_status', 'pending')->count();
    }

    public function getTotalTransactionPaid()
    {
        return $this->model->where('transaction_status', 'paid')->count();
    }

    public function getTotalTransactionDone()
    {
        return $this->model->where('transaction_status', 'done')->count();
    }

    public function getTotalTransactionFailed()
    {
        return $this->model->where('transaction_status', 'failed')->count();
    }

    public function checkTransactionPendingByUser()
    {
        return $this->model->where(['user_id' => Auth::user()->id, 'transaction_status' => 'pending'])->first();
    }

    public function getTotalTransactionPendingByUser()
    {
        return $this->model->where(['user_id' => Auth::user()->id, 'transaction_status' => 'pending'])->count();
    }

    public function getTotalTransactionPaidByUser()
    {
        return $this->model->where(['user_id' => Auth::user()->id, 'transaction_status' => 'paid'])->count();
    }

    public function getTotalTransactionDoneByUser()
    {
        return $this->model->where(['user_id' => Auth::user()->id, 'transaction_status' => 'done'])->count();
    }

    public function getTotalTransactionFailedByUser()
    {
        return $this->model->where(['user_id' => Auth::user()->id, 'transaction_status' => 'failed'])->count();
    }

    public function update($attributes, $id)
    {
        $input = $attributes->except('_token', '_method');
        $setting = Setting::first();

        $token = $attributes->transaction_status == "done" ? strtoupper(Str::random(15)) : null;
        $input['voucher_token'] = $token;
        $transaction = $this->model->find($id);
        $transaction->update($input);

        $user = User::find($transaction->user_id);

        if ($attributes->transaction_status == "paid") {
            $message = "*[TRANSAKSI ".(strtoupper($setting->app_name ?? "isi data setting terlebih dahulu"))."]*\n\nNomor Transaksi: ".$transaction->code."\ntotal Pembayaran: *Rp".number_format($transaction->total_purchases, 2, ",", ".")."*\n\n*PEMBAYARAN TELAH DITERIMA*\n\nterimakasih.";
        } elseif ($attributes->transaction_status == "failed") {
            $message = "*[TRANSAKSI ".(strtoupper($setting->app_name ?? "isi data setting terlebih dahulu"))."]*\n\nNomor Transaksi: ".$transaction->code."\nTotal Pembayaran: *Rp".number_format($transaction->total_purchases, 2, ",", ".")."*\n\n*TRANSAKSI DIBATALKAN, SILAKAN LAKUKAN TRANSAKSI ULANG*\n\nterimakasih.";
        } elseif ($attributes->transaction_status == "done") {
            $message = "*[TRANSAKSI ".(strtoupper($setting->app_name ?? "isi data setting terlebih dahulu"))."]*\n\n Berikut Token Untuk Nomor Transaksi: ".$transaction->code."\nTotal Pembayaran: *Rp".number_format($transaction->total_purchases, 2, ",", ".")."*\n\n*TOKEN ANDA*\n*".$transaction->voucher_token."*\n\nSilakan masukan token untuk aktivasi status member anda di menu *AKTIVASI VOUCHER*.\n\nterimakasih.";
        }
    
        sendWhatsappNotification($transaction->user->student->phone_number, $message);

        return $transaction;
    }

    public function createTransacationWithExamId($id)
    {
        $exam = Exam::find($id);

        $transaction = [
            'user_id' => Auth::user()->id,
            'exam_id' => $exam->id,
            'code' => Transaction::generateCode(),
            'date' => Carbon::now(),
            'voucher_token' => $exam->price == 0 ? strtoupper(Str::random(15)) : null,
            'total_purchases' => $exam->price,
            'maximum_payment_time' => Carbon::now()->addDays(2),
            'transaction_status' => $exam->price == 0 ? 'done' : 'pending'
        ];

        $transaction = $this->model->create($transaction);

        $user = User::find($transaction->user_id);
        $setting = Setting::first();

        if($exam->price == 0) {
            $message = "*[TRANSAKSI ".(strtoupper($setting->app_name ?? "isi data setting terlebih dahulu"))."]*\n\n Berikut Token Untuk Nomor Transaksi: ".$transaction->code."\nTotal Pembayaran: *Rp".number_format($transaction->total_purchases, 2, ",", ".")."*\n\n*TOKEN ANDA*\n*".$transaction->voucher_token."*\n\nSilakan masukan token untuk aktivasi status member anda di menu *AKTIVASI VOUCHER*.\n\nterimakasih.";
        } else {
            $message = "*[TRANSAKSI ".(strtoupper($setting->app_name ?? "isi data setting terlebih dahulu"))."]*\n\nNomor Transaksi: ".$transaction->code."\nTotal Pembayaran: *Rp".number_format($transaction->total_purchases, 2, ",", ".")."*\nMaksimal Pembayaran: ".$transaction->maximum_payment_time."\n\n*_token voucher akan dikirimkan setelah anda membayar ke nomor rekening yang terdaftar, silakan konfirmasi dan kirim bukti pembayaran ke Whatsapp ini._*\n\nterimakasih.";
        }

        sendWhatsappNotification($user->student->phone_number, $message);

        return $transaction;
    }



}
