<?php 
Route::get('/','Home/Index/index');
Route::get('list','Home/List/index');
Route::get('ll{gid}.html','Home/Goods/index');