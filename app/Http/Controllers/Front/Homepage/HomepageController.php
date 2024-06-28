<?php

namespace App\Http\Controllers\Front\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $data = [
            '__title' => 'Ana Sayfa',
            '__breadcrumbs' => [
                ['title' => 'Ana Sayfa', 'url' => route('front.homepage')],
            ],
        ];
        return view('front.pages.homepage', $data);
    }
}
