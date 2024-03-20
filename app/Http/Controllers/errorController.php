<?php

namespace App\Http\Controllers;
class errorController extends Controller
{
   public function getError()
   {
       abort(404);
       //include ((dirname(__DIR__, 2) . '/File/' .'Error404.html'));
   }
}
