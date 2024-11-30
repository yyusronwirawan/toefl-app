<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    // protected $dates = ['created_at', 'maximum_payment_time', 'date'];

    protected $fillable = [
        'id',
        'user_id',
        'exam_id',
        'code',
        'voucher_activated',
        'voucher_used',
        'total_purchases',
        'maximum_payment_time',
        'transaction_status',
        'voucher_token',
    ];

    public static function generateCode()
    {
        $code = 'INV';
        $sequence = 1;
        $format = formatCode($code, $sequence);
        $result = null;

        while (true) {
            $query = static::where('code', $format)->first();
            if (empty($query)) {
                $result = $format;
                break;
            }
            $format = formatCode($code, ++$sequence);
        }

        return $result;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam\Exam::class);
    }

    public function getDateAttribute($value)
    {
        return dateFormat($value, 'd F Y');
    }

    public function getVoucherExpiredDateAttribute($value)
    {
        return empty($value) ? '-' : dateFormat($value, 'd F Y');
    }

    public function getMaximumPaymentTimeAttribute($value)
    {
        return dateFormat($value, 'd F Y H:i');
    }

    public function getCreatedAtAttribute($value)
    {
        return dateFormat($value, 'd F Y H:i');
    }

    public function getIsExpiredAttribute()
    {
        return $this->attributes['voucher_expired_date'] < Carbon::now() ? true : false; 
    }
}
