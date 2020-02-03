<?php

declare (strict_types=1);

namespace App\Model;

/**
 * @property int $id
 * @property string $article_title
 * @property string $article_description
 * @property string $article_content
 * @property int $image_id
 * @property int $administrator_id
 * @property int $like_num
 * @property int $view_new
 * @property int $words_num
 * @property int $reply_num
 * @property int $article_status
 * @property int $created_time
 * @property int $updated_time
 * @property int $is_del
 */
class Article extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';
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
    protected $casts = ['id' => 'int', 'user_id' => 'integer', 'like_num' => 'integer', 'view_new' => 'integer', 'words_num' => 'integer', 'reply_num' => 'integer', 'article_status' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'is_del' => 'integer'];

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

    /**
     * Author : helinhan@styd.cn
     * Date   : 2020-02-02 22:06
     * @return \Hyperf\Database\Model\Relations\HasOne
     */
    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'id', 'administrator_id')->select(['id', 'nickname', 'image_id', 'image_url']);
    }

    /**
     * Author : helinhan@styd.cn
     * Date   : 2020-02-02 20:47
     * @param array $fields
     * @param array $conditions
     * @return \Hyperf\Database\Model\Builder
     */
    public static function getQuery($fields = ['*'], $conditions = [])
    {
        return self::query()->select($fields)->where($conditions);
    }

    /**
     * Author: Galen
     * Date: 2020/1/6 22:31
     * @param $id
     * @param $fields
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|object|null
     */
    public static function getInfoById($id, $fields = ['*'])
    {
        return self::getQuery($fields, ['id' => $id])->first();
    }
}