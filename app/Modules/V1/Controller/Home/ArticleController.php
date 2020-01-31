<?php

declare(strict_types=1);

namespace App\Modules\V1\Controller\Home;

use App\Helper\CommonConstHelper;
use App\Modules\V1\Controller\BaseController;
use App\Modules\V1\Services\Home\ArticleService;

class ArticleController extends BaseController
{
    /**
     * 获取列表
     * Author : helinhan@styd.cn
     * Date   : 2020-01-31 17:37
     * @return array
     */
    public function getArticleList()
    {
        $page = (int)$this->request->input('p', CommonConstHelper::CURRENT_PAGE_DEFAULT);
        $size = (int)$this->request->input('s', CommonConstHelper::PAGE_SIZE_DEFAULT);
        $keyword = $this->request->input('q', '');

        return ArticleService::getArticleList($keyword, $page, $size);
    }


    /**
     * 获取详情
     * Author : helinhan@styd.cn
     * Date   : 2020-01-31 17:37
     * @param int $id
     * @return array
     */
    public function getArticleInfo(int $id)
    {
        return ArticleService::getArticleInfo($id);
    }
}
