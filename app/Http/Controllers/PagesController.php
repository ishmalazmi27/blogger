<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function Home()
    {
        $this->index();
    }

    public function About()
    {
        return view('pages.about');
    }

    public function Services()
    {
        $data = array(
            'services' => ['Blog Posting', 'Blog Reviews', 'Portfolios Of Famous Bloggers']
        );
        return view('pages.services')->with($data);
    }

    public function Posts()
    {
        return view('posts.index');
    }
}
