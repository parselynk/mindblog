<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{

    public function isAdminRequest()
    {
        return str_contains(Route::current()->getPrefix(), 'admin');
    }

    public function getView(string $action = 'index')
    {
        return ($this->isAdminRequest()) ? "articles.admin.{$action}" : "articles.{$action}";
    }
}
