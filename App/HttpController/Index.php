<?php

namespace App\HttpController;
use Illuminate\Database\Capsule\Manager as DB;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class Index extends Controller
{
    function index()
    {
	    // $version = DB::select('select version();');
	    // var_dump($version);
	    $this->response()->write('11111');
    }
}