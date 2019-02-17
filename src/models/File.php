<?php
namespace Xyrotech\Stratus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class File extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'user_id', 'folder_id', 'token', 'updated_at', 'size', 'path'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $table = 'stratus_table';
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function folder() {
        return $this->belongsTo('App\Folder');
    }
    public function link()
    {
        return $this->morphOne('App\Link', 'linkable');
    }
    public function transfer()
    {
        return $this->morphOne('App\Transfer', 'object');
    }
}
