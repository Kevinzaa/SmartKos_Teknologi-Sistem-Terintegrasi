<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class HomeController extends BaseController
{
    public function welcome()
    {
        return view('welcome_view');
    }
}
