<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        return view('frontend.index-book');
    }

    function about_us()
    {
        return view('frontend.about_us');
    }
    function blog_details_slidebar()
    {
        return view('frontend.blog-details-slidebar');
    }
    function blog()
    {
        return view('frontend.blog');
    }
    function cart()
    {
        return view('frontend.cart');
    }
    function checkout()
    {
        return view('frontend.checkout');
    }
    function conceptual()
    {
        return view('frontend.conceptual');
    }
    function contact()
    {
        return view('frontend.contact');
    }
    function digitalart()
    {
        return view('frontend.digitalart');
    }
    function drawings()
    {
        return view('frontend.drawings');
    }

    function index_book()
    {
        return view('frontend.index-book');
    }
    function login()
    {
        return view('frontend.login');
    }
    function paintings()
    {
        return view('frontend.paintings');
    }
    function photography()
    {
        return view('frontend.photography');
    }
    function product_details()
    {
        return view('frontend.product-details');
    }
    function register()
    {
        return view('frontend.register');
    }
    function sculpture()
    {
        return view('frontend.sculpture');
    }

    function shop_grid_box()
    {
        return view('frontend.shop-grid-box');
    }
    function shop()
    {
        return view('frontend.shop');
    }
    function wishlist()
    {
        return view('frontend.wishlist');
    }
}
