<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 17.11.2018
 * Time: 14:34
 */

namespace App\Providers;



use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config;
use FacebookAds\Api;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Logger\CurlLogger;

use FacebookAds\Object as FacebookAdsObject;



class FacebookSDKProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton(Api::class, function () {
            $config = $this->app->make(Config\Repository::class);
            $api = Api::init(
                $config->get('facebooksdk.app_id'),
                $config->get('facebooksdk.app_secret'),
                $config->get('facebooksdk.app_token')
            );

            $api->setLogger(new CurlLogger);


            return $api;
        });


        $this->app->when([
            FacebookAdsObject\AdAccount::class,
        ])
            ->needs('$id')
            ->give(
                function () {
                    return $this->app->make(Config\Repository::class)->get('facebooksdk.account_id');
                }
            );

        $this->app->when([
            FacebookAdsObject\Campaign::class,
        ])
            ->needs('$id')
            ->give(
                function () {
                    return $this->app->make(Config\Repository::class)->get('facebooksdk.campaign_id');
                }
            );

        /*  $this->app->when([Object\AdAccount::class])
              ->needs('$id')
              ->give(function() {
                  $this->app->get(Api::class);*
                  $config = $this->app->make()
              });*/
    }

                    /*
                   $this->app->bind(AdAccount::class, function() {
                       $this->app->get(Api::class);
                       $config = $this->app->get(Config\Repository::class);

                   });*/
}