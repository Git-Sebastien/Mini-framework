<?php 

namespace App\Controller;

use Core\Controller;
use Core\Facades\Query;
use Core\Interfaces\RenderMethod;
use App\Models\UsersManager;

class HomeController extends Controller implements RenderMethod {

    public function index($id)
    {
        $user = Query::table('users')
        ->select('name')
        ->where('name',"=","Myla")
        ->get();

    //    $user =  UsersManager::create([
    //         "name"=>"Myla",
    //         "firstname"=>"Ancelin",
    //         "email"=>"email@fr.fr"
    //    ]);

        return $this->render('home',compact('user'));
    }
}