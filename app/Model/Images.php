<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property string $image_url 
 * @property int $cover_type 
 * @property int $created_time 
 * @property int $updated_time 
 * @property int $is_del 
 */
class Images extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';
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
    protected $casts = ['id' => 'int', 'cover_type' => 'integer', 'created_time' => 'integer', 'updated_time' => 'integer', 'is_del' => 'integer'];
}