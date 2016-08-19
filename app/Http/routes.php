<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(["middleware" => ["web"]], function () {

    // route to homepage
    Route::get("/", ["as" => "getHome", "uses" => "PagesController@getHome"]);

    // post route to send email from contact form
    Route::post("/contact", ["before" => "csrf", "as" => "postContact", "uses" => "ContactFormController@postContact"]);

    // sitemap.xml route
    Route::get("/sitemap.xml", ["as" => "sitemap", "uses" => "SitemapController@getSitemapXml"]);

    // robots.txt route
    Route::get("/robots.txt", ["as" => "robots", "uses" => "RobotsController@getRobotsTxt"]);

    // any other route that gets page based on the url
    Route::get("/{url}", ["as" => "getPage", "uses" => "PagesController@getPage"])
        ->where("url", "[0-9, a-z, A-Z, \-]+");
});
