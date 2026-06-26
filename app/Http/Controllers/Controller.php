<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Basicamente é autorizar e validar requerimentos da pasta controllers
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
