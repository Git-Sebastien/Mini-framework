<?php 

namespace App\Controller;

use Core\Controller;
use Core\Interfaces\RenderMethod;

class PostsController extends Controller implements RenderMethod{

    public function index()
    {
        $var = "lol";
        return $this->render('posts',compact('var'));
    }

}