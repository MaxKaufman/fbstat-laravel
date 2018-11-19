<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config;
use FacebookAds\Api;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Logger\CurlLogger;

//попробую инициализировать поля
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Fields\AdSetFields;


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

//выводим инфу об аккаунт, с id компаний
Route::get('/accountlevel', function (Campaign $adCampaign) {


    $api = Api::init('1805043902954463', '1f2c3e4c200fa50bcbe4458d9e5bad95', 'EAAZAprYiju98BALaUDxhGgUBi02sTlgyqdCaIZBRlqkcl9zI5x7lvx2WoaTZCMelRzNwZBPHXSiRb5svj9z97ZAegGK6TZBmUw8t7R5Tw5UgShu6R2HHaUHIlAaFwZB72ToZAQcVHpNbp3sUBA7GuFQeOYKWW8648EZBFDFZALU4ZCkbgZDZD');
    $api->setLogger(new CurlLogger());

    $fields = array(
        'name',
        'campaigns',
    );
    $fields = array(
        AdAccountFields::ID,
        AdAccountFields::NAME,
        AdAccountFields::DAILY_SPEND_LIMIT,
    );
    $params = array(
    );
    $result =  json_encode((new AdAccount('act_672161539625317'))->getSelf(
        $fields,
        $params
    )->exportAllData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    dd($result);

});

Route::get('/campaignlevel', function (Campaign $adCampaign) {


    $api = Api::init('1805043902954463', '1f2c3e4c200fa50bcbe4458d9e5bad95', 'EAAZAprYiju98BALaUDxhGgUBi02sTlgyqdCaIZBRlqkcl9zI5x7lvx2WoaTZCMelRzNwZBPHXSiRb5svj9z97ZAegGK6TZBmUw8t7R5Tw5UgShu6R2HHaUHIlAaFwZB72ToZAQcVHpNbp3sUBA7GuFQeOYKWW8648EZBFDFZALU4ZCkbgZDZD');
    $api->setLogger(new CurlLogger());

    $fields = array(
        'name',


    );
    $params = array(
        'field' => 'campaign.id',
        'operator'=> 'EQUAL',
        'value' => '23843092343900431',
    );
    $result =  json_encode((new AdAccount('act_672161539625317'))->getSelf(
        $fields,
        $params
    )->exportAllData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    dd($result);

});

Route::get('/campaignlevel', function () {

    $account_id = 'act_672161539625317';
    $campaign_id = '23843092343900431';

    $account = new AdAccount('<ACT_ID>');
    $cursor = $account->getCampaigns(['23843092343900431','Тантум прополис']);

// Loop over objects
    foreach ($cursor as $campaign) {
        echo $campaign->{CampaignFields::NAME}.PHP_EOL;
    }

// Access objects by index
    if ($cursor->count() > 0) {
        echo "The first campaign in the cursor is: ".$cursor[0]->{CampaignFields::NAME}.PHP_EOL;
    }

// Fetch the next page
    $cursor->fetchAfter();
// New Objects will be appended to the cursor
    dd($cursor);
    return true;
});


//Вывел все показы adset
Route::get('/adstest', function() {
    $api = Api::init('1805043902954463', '1f2c3e4c200fa50bcbe4458d9e5bad95', 'EAAZAprYiju98BALaUDxhGgUBi02sTlgyqdCaIZBRlqkcl9zI5x7lvx2WoaTZCMelRzNwZBPHXSiRb5svj9z97ZAegGK6TZBmUw8t7R5Tw5UgShu6R2HHaUHIlAaFwZB72ToZAQcVHpNbp3sUBA7GuFQeOYKWW8648EZBFDFZALU4ZCkbgZDZD');
    $api->setLogger(new CurlLogger());

    $fields = array(
        'impressions',
        'clicks',
        'reach',
        'spend',
        'ctr',
        'campaign_name',
        'campaign_id',
        'adset_name',
        'adset_id'
        //fields = "campaign_name,campaign_id,adset_name,adset_id,ad_name,ad_id,impressions,clicks,reach,spend,ctr",
    );
    $params = array(
        'time_range[since]' => '2018-10-15',
        'time_range[until]' => '2018-11-15',
       // 'breakdown' => 'publisher_platform',
    );

    $result = json_encode((new AdSet('23843092358210431'))->getInsights(
        $fields,
        $params
    )->getResponse()->getContent(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    dd($result);
});