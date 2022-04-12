<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ads\Advertising;

class StateAd extends Model
{
    use HasFactory;

    protected $table = 'state_ad';
    protected $fillable = ['active', 'advertisements_id'];

    // Relación inversa de uno a uno.
    public function advertising (){
        return $this->belongsTo(Advertising::class, 'advertisements_id');
    }
}
