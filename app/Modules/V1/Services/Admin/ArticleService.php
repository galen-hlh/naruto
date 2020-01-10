<?php

declare(strict_types=1);

namespace App\Modules\V1\Services\Admin;

use App\Helper\Helper;
use App\Model\Article;

class ArticleService
{
    public static function getArticleInfo(int $id)
    {
        return Article::getInfoById($id);
    }

    public static function getArticleList(int $page, int $size)
    {
        $articleQuery = Article::getListQuery();
        return Helper::pagination($articleQuery, $page, $size);
    }

    public static function addArticle(array $params)
    {
        $article = new Article();
        $article->setRawAttributes($params);
        return $article->save();
    }
}