<?php
namespace Xyrotech\Stratus\Models;
use Illuminate\Database\Eloquent\Model;
class Link extends Model
{
    protected $fillable = ['expire_at', 'token', 'password', 'linkable_id', 'linkable_type'];
    protected $dates = ['expire_at'];
    public function linkable() {
        return $this->morphTo();
    }
}