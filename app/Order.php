<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'account_id', 'buyer', 'item', 'transaction_id', 'quantity',
        'address', 'tracking', 'last_update', 'price', 'note', 'paid_on_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return float|int
     */
    static public function needPay()
    {
        $users = User::all();
        $rs = 0;
        foreach ($users as $user) {
            $rs += $user->needPay();
        }
        return $rs;
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'Delivered');
    }

    public function scopeNewOrders($query)
    {
        return $query->where('status', 'order_new');
    }

    public function scopeTrackAddedNotDelivery($query)
    {
        return $query->whereNotNull('tracking')->where('status', '!=' , 'Delivered');
    }

    public function scopeInProgressNotAddTrack($query)
    {
        return $query->whereNull('tracking')->whereNotNull('number');
    }
}
