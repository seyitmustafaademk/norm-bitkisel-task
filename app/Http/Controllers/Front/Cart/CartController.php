<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            '__title' => 'Sepet',
            '__breadcrumbs' => [
                ['title' => 'Ana Sayfa', 'url' => route('front.homepage')],
                ['title' => 'Sepet']
            ],
        ];
        return view('front.pages.cart', $data);
    }
}
