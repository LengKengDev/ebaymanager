<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'per'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'note'
    ];

    protected $maps = ['note' => 'user_note'];
    protected $appends = ['note_user'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTransactions(Request $request)
    {
        return $this->transactions()->paginate(10);
    }



    /**
     * @return mixed
     */
    public function totalAmount()
    {
        return $this->orders()->sum('price');
    }

    /**
     * @return mixed
     */
    public function totalTransactions()
    {
        return $this->transactions()->sum('value');
    }

    /**
     * @return mixed
     */
    public function totalAmountDelivered()
    {
        return $this->orders()->where("status", "Delivered")->sum('price');
    }

    /**
     * @return int
     */
    public function totalOrdersDelivered()
    {
        return $this->orders()->where("status", "Delivered")->count();
    }

    /**
     * @return mixed
     */
    public function needPay()
    {
        return $this->totalAmountDelivered() * $this->per / 100 - $this->totalTransactions();
    }

    /**
     * @return mixed
     */
    public function getNoteUserAttribute()
    {
        return $this->attributes['note'];
    }
}


