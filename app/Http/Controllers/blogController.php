<?php

namespace App\Http\Controllers;

use App\DTO\ArticleDTO\ItemDTO;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class blogController extends Controller
{
    protected function getItemDTO():ItemDTO
    {
        return new ItemDTO();
    }
    public function web(Request $request, ArticleService $articleService)
    {

        $article = $this->getItemDTO();
        $article->author = $request->post('Author');
        $article->nameArticle = $request->post('nameArticle');
        $article->article = $request->post('Article');
        $articles ='Автор статьи ' . $article->nameArticle . ' неподражаемый ' .$article->author.'. Статья:'. $article->article;
        //$articles = $articleService->putArticle($article);
        return view('card', compact('articles'));
    }

}
