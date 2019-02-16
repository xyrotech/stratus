<?php
namespace Xyrotech\Stratus\Models;
use Illuminate\Database\Eloquent\Model;
class UserOptions extends Model
{
    protected $fillable = ['notify_file', 'notify_folder', 'notify_add', 'email'];
    protected $table = "user_options";
    protected $primaryKey = 'user_id';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}