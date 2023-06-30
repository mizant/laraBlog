<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $guarded = false;

    function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getDataAsCarbonAttribute() {
        return Carbon::parse($this->created_at);
    }
}
