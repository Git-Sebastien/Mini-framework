<?php 

namespace App\Controller;

use Core\Controller;
use Core\Database\Database;
use Core\Facades\Query;
use Core\Interfaces\RenderMethod;

class HomeController extends Controller implements RenderMethod {

    public function index()
    {
        $query = Query::table('users')
        ->select('name')
        ->where('name',"=","seb")
        ->get();
        dd($query);
        return $this->render('home',compact('query'));
    }
}