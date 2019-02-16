<?php
namespace Xyrotech\Stratus\Models;

use Illuminate\Database\Eloquent\Model;
class Clam extends Model
{
    protected $fillable = ['created_at', 'updated_at', 'type', 'remote_addr', 'folder_id'];
    protected $table = "clamav";
    public function folder() {
        return $this->belongsTo('App\Folder');
    }
}