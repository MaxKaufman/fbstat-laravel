<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config;
use FacebookAds\Api;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Logger\CurlLogger;

use FacebookAds\Object as FacebookAdsObject;



Route::get('/', function (AdAccount $adAccount) {

    $fields = array(
        'name'
    );
    $params = array(

    );

    $result = $adAccount->getAdCreatives(
        $fields,
        $params
    )->getLastResponse()->getContent();

    dd($result);

    return json_encode($result , JSON_UNESCAPED_UNICODE);

    return view('welcome');
});

//выводим инфу об аккаунте
Route::get('/campaignlevel', function (Campaign $adCampaign) {


    $api = Api::init('1805043902954463', '1f2c3e4c200fa50bcbe4458d9e5bad95', 'EAAZAprYiju98BALaUDxhGgUBi02sTlgyqdCaIZBRlqkcl9zI5x7lvx2WoaTZCMelRzNwZBPHXSiRb5svj9z97ZAegGK6TZBmUw8t7R5Tw5UgShu6R2HHaUHIlAaFwZB72ToZAQcVHpNbp3sUBA7GuFQeOYKWW8648EZBFDFZALU4ZCkbgZDZD');
    $api->setLogger(new CurlLogger());

    $fields = array(
        'name',


    );
    $params = array(
    );
    $result =  json_encode((new AdAccount('act_672161539625317'))->getSelf(
        $fields,
        $params
    )->exportAllData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    dd($result);

});

