<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('templates/header.view.php').view('index.view.php').view('templates/footer.view.php');
    }
}
