<?php

namespace App\Http\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function createUsers($usersBEntity){
        $usersId = DB::table('users')->insertGetId(
            array(
                'name' => $usersBEntity->getName(),
                'email' => $usersBEntity->getEmail(),
                'password' => bcrypt($usersBEntity->getPassword()),
                'role_id'=>$usersBEntity->getRoleId(),
                'created_at'=> $usersBEntity->getAuditoryInformation()->getCreatedDate()

            )
        );
        return $usersId;
    }
    public static function updateUsers($userBEntity){

        DB::table('users')
            ->where('id',$userBEntity->getId())
            ->update(
                array(
                    'name' => $userBEntity->getName(),
                    'password' => bcrypt($userBEntity->getPassword()),
                    'email'=> $userBEntity->getEmail(),
                    'role_id'=>$userBEntity->getRoleId(),
                    'updated_at'=>$userBEntity->getAuditoryInformation()->getModifiedDate()
                )
            );
    }
    public static function getTotalUsers(){
        $result=DB::table('users')
            ->count();
        return $result;
    }
}
