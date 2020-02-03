<?php

declare(strict_types=1);

namespace App\Modules\V1\Services\Home;

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
        //获取文章信息
        $fields = ['id', 'article_title', 'article_description', 'article_content', 'image_id', 'administrator_id', 'view_num', 'words_num', 'created_time'];
        $article = Article::getInfoById($id, $fields);

        //获取关联关系
        $administratorInfo = $article->administrator;
        $imageInfo = $article->images;

        return [
            'info' => [
                'id' => (string)$article['id'],
                'title' => $article['article_title'],
                'content' => $article['article_content'],
                'image' => $imageInfo['image_url'],
                'publish_time' => $article['created_time'],
                'publisher_avatar' => $administratorInfo['image_url'],
                'publisher_name' => $administratorInfo['nickname'],
                'view_num' => $article['view_num'],
                'words_num' => $article['words_num'],
            ]
        ];
    }

    /**
     * 获取文章列表
     * Author : helinhan@styd.cn
     * Date   : 2020-01-31 17:38
     * @param string $keyword
     * @param int $page
     * @param int $size
     * @return array
     */
    public static function getArticleList(string $keyword, int $page, int $size)
    {
        $fields = ['id', 'article_title', 'article_description', 'image_id', 'administrator_id', 'like_num', 'reply_num', 'created_time'];
        $articleQuery = Article::getQuery($fields)->with('administrator')->with('images');
        if ($keyword) {
            $articleQuery->where('article_title', 'like', $keyword);
        }

        $result = Helper::pagination($articleQuery, $page, $size);

        $list = [];
        foreach ($result['list'] as $row) {
            $list [] = [
                'id' => (string)$row['id'],
                'title' => $row['article_title'],
                'description' => $row['article_description'],
                'image' => $row['images']['image_url'],
                'publish_time' => $row['created_time'],
                'publisher_name' => $row['administrator']['nickname'],
                'like_num' => $row['like_num'],
                'reply_num' => $row['reply_num'],
            ];
        }
        $result['list'] = $list;

        return $result;
    }
}