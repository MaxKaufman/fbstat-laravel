<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use FacebookAds\Api;
use FacebookAds\Object\AdAccount;

use FacebookAds\Object\AdSet;



Route::get('/', function (AdAccount $adAccount) {

    $fields = array(
        'name'
    );
    $params = array(

    );

    $result = $adAccount->getAdCreatives(
        $fields,
        $params
    )->getLastResponse()->getcontent();

    dd($result);

    return json_encode($result , JSON_UNESCAPED_UNICODE);

    return view('welcome');
});