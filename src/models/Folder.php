<?php
namespace Xyrotech\Stratus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Folder extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'user_id', 'location', 'token', 'updated_at', 'size'];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function files() {
        return $this->hasMany('App\File');
    }
    public function link()
    {
        return $this->morphOne('App\Link', 'linkable');
    }
}