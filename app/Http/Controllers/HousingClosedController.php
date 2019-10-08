<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LockController;

class HousingClosedController extends LockController
{
    public $model = "App\HousingClosed";
}