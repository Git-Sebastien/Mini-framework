<?php 

namespace App\Controller;

use Core\Controller;
use Core\Interfaces\RenderMethod;

class CommentsController extends Controller implements RenderMethod{

    public function index()
    {
        $lol = 'lol';
        $this->render('comments',compact('lol'));
    }
}