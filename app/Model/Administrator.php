<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $image_id
 * @property string $image_url
 * @property string $account 
 * @property int $account_type 
 * @property string $password 
 * @property string $nickname 
 * @property string $email 
 * @property string $phone 
 * @property int $is_del 
 * @property int $created_time 
 * @property int $updated_time 
 */
class Administrator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'administrator';
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
    protected $casts = ['id' => 'int', 'account_type' => 'integer', 'is_del' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer'];

    /**
     * Author : helinhan@styd.cn
     * Date   : 2020-02-02 22:06
     * @return \Hyperf\Database\Model\Relations\HasOne
     */
    public function images()
    {
        return $this->hasOne(Images::class, 'id', 'image_id')
            ->select(['id', 'image_url', 'cover_type']);
    }

    public static function getInfoByAccount(string $username, array $fields=['*'])
    {
        return self::query()->where(['account'=>$username])->select($fields)->first();
    }
}