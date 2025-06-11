<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/post', function () {
    $posts = [
        [
            'title' => 'Judul Artikel 1',
            'author' => 'Mero',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias impedit similique, rerum temporibus dolorum sint delectus rem quibusdam optio deserunt modi? Nisi asperiores odit saepe illum iusto voluptate nam sit?',
        ],
         [
            'title' => 'Judul Artikel 2',
            'author' => 'Mika',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex, sequi odit. Corporis, odio nesciunt. Ipsum sint, officia delectus, repellendus magni esse accusamus labore placeat expedita mollitia architecto non deserunt repellat.',
        ],
    ];
    return view('posts', ['title' => 'Blog Page', 'posts' => $posts]);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Page']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Page']);
});
