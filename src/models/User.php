<?php
namespace Xyrotech\Stratus\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function folder()
    {
        return $this->hasOne('App\Folder');
    }
    public function files()
    {
        return $this->hasManyThrough('App\File', 'App\Folder');
    }
    public function options()
    {
        return $this->hasOne('App\UserOptions', 'user_id');
    }
}