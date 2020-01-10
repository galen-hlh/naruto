<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property string $account 
 * @property int $account_type
 * @property string $password 
 * @property string $nickname 
 * @property string $email 
 * @property string $phone 
 * @property int $is_del 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Users extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'int', 'account_type' => 'integer', 'is_del' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];


    public static function getUserInfoByUsername(string $username, array $fields=['*'])
    {
        return self::query()->where(['account'=>$username])->select($fields)->first();
    }
}