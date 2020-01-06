<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $article_name 
 * @property string $description 
 * @property string $content 
 * @property int $user_id 
 * @property int $is_top 
 * @property int $updated_time 
 * @property int $created_time 
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
    protected $casts = ['id' => 'int', 'user_id' => 'integer', 'is_top' => 'integer', 'updated_time' => 'integer', 'created_time' => 'integer', 'is_del' => 'integer'];
}