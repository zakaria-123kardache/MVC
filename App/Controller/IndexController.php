<?php

namespace App\Controller;

use App\Controller\Controller;

class IndexController extends Controller {
    

    public function index ()
    {
        return $this->render("pages.home");
    }
    public function about ()
    {
        return $this->render("pages.about");
    }
    
}
