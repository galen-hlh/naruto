<?php

declare(strict_types=1);

namespace App\Modules\V1\Services\Home;

use App\Components\IdGenerator;
use App\Helper\Helper;
use App\Model\Article;

class ArticleService
{
    /**
     * 获取文章详情
     * Author : helinhan@styd.cn
     * Date   : 2020-01-31 17:38
     * @param int $id
     * @return array
     */
    public static function getArticleInfo(int $id)
    {
        return ["info" => Article::getInfoById($id)];
    }

    /**
     * 获取文章列表
     * Author : helinhan@styd.cn
     * Date   : 2020-01-31 17:38
     * @param string $keyword
     * @param int $page
     * @param int $size
     * @return array
     *
     */
    public static function getArticleList(string $keyword, int $page, int $size)
    {
        $articleQuery = Article::getListQuery();
        if ($keyword){
            $articleQuery->where('article_title', 'like', $keyword);
        }
        return Helper::pagination($articleQuery, $page, $size);
    }
}