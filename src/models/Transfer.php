<?php
namespace Xyrotech\Stratus\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Transfer extends Model
{
    protected $fillable = ['remote_addr', 'object_id', 'object_type', 'direction'];
    public function object() {
        return $this->morphTo()->withTrashed()->with('folder');
    }
    public function getCreatedAtAttribute($value)
    {
        $carbon = new Carbon($value);
        return $carbon->format('D\, F jS\, Y \a\t g:i A ');
    }
}