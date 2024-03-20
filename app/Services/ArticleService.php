<?php

namespace App\Services;
use App\DTO\ArticleDTO\ItemDTO;

class ArticleService extends Service
{
    protected function getItemDTO(): ItemDTO
    {
        return new ItemDTO();
    }

    protected function getFileArticle()
    {
       return file_get_contents((dirname(__DIR__, 1) . '/File/Articles.log'));
    }

    public function putArticle($article)
    {
        $listArticle = [$this->getItemDTO()];
        $listArticle[] = json_decode($this->getFileArticle(),true);
        foreach ($listArticle as $articles) {
            if ($articles <> $article) {
                $listArticle[] = $article;
               // var_dump($articles);
//                file_put_contents((dirname(__DIR__, 1) . '/File/Articles.log'),json_encode($listArticle,0) );
            }
        }
        $result =[];
        //var_dump($listArticle);
        foreach ($listArticle as $count=>$value) {
            $result[] = 'Автор статьи-  ' . $count['author'] ;//. 'Статья ' . $count->nameArticle;
        }
        return $result;
    }
}
