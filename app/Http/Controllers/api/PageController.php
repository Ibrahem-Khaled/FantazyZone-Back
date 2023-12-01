<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::all();
        return response()->json($pages);
    }
    public function create(Request $request)
    {
        $requests = $request->all();
        $page = Page::create($requests);
        return response()->json($page);
    }
}
