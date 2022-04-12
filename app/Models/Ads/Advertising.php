<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ads\StateAd;

class Advertising extends Model
{
    use HasFactory;

    protected $table = 'advertisements';
    //protected $hidden = ['id'];
    protected $fillable = ['advertising', 'head', 'block', 'horizontal', 'vertical'];
    
    // Relación de uno a uno.
    public function statusAd (){
        return $this->hasOne(StateAd::class, 'advertisements_id');
    }
}
