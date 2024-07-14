<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
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
     public function hotels(){
        return $this->hasMany(Hotel::class);
    }
}
