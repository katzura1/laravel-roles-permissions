<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
    public function all(Request $request)
    {
        $menus = Menu::with([
            'child' => function ($query) {
                $query->where('type', 'parent');
            },
            'child.child'
        ])->whereNull('id_parent')->where('type', 'parent')->get();
        return response()->json($menus);
    }
}
