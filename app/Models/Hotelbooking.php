<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotelbooking extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */

    protected $table      = 'hotelbookings';
    protected $guarded    = [];
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $createdAt  = ['created_at'];
    protected $updatedAt  = ['updated_at'];

    //    for casting merubah string jadi tanggal
    protected $casts    = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function hotelroom(){
        return $this->belongsTo(Hotelroom::class, 'hotelroom_id');
    }
}
