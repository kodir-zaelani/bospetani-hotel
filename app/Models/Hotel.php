<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

         /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded    = [];
    protected $primaryKey = 'id';

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function photos(){
        return $this->hasMany(Hotelphoto::class);
    }

     public function hotelrooms(){
        return $this->hasMany(Hotelroom::class);
    }

    public function getLowesRoomPrice(){
        $minPrice = $this->hotelrooms()->min('price');
        return $minPrice ?? 0;
    }
}
