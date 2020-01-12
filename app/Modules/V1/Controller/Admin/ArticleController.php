<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Admin;

use App\Helper\CommonConstHelper;
use App\Components\User;
use App\Modules\V1\Controller\BaseController;
use App\Modules\V1\Services\Admin\ArticleService;
use Hyperf\HttpServer\Contract\RequestInterface;

class ArticleController extends BaseController
{
    /**
     * article info
     * Author: Galen
     * Date: 2020/1/10 22:19
     * @param int $id
     * @return array
     */
    public function get(int $id)
    {

        return ['info' => ArticleService::getArticleInfo($id),];
    }

    /**
     * article list
     * Author: Galen
     * Date: 2020/1/10 22:19
     * @param RequestInterface $request
     * @return array
     */
    public function list(RequestInterface $request)
    {
        $page = $request->input('page', CommonConstHelper::CURRENT_PAGE_DEFAULT);
        $size = $request->input('size', CommonConstHelper::PAGE_SIZE_DEFAULT);
        return ArticleService::getArticleList($page, $size);
    }

    /**
     * add article
     * Author: Galen
     * Date: 2020/1/10 22:19
     * @param RequestInterface $request
     * @return bool
     */
    public function add(RequestInterface $request)
    {
        $params = [
            'article_title' => $request->input('article_title', ''),
            'description' => $request->input('description', ''),
            'content' => $request->input('content', ''),
            'user_id' => User::getUserId(),
        ];

        return ArticleService::addArticle($params);
    }
}