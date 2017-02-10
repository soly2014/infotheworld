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

/* site map xml */

Route::post('/addmultilang','AdminController@addMulti');

Route::get('sitemap', function(){


    // create new sitemap object
    $sitemap = App::make("sitemap");

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 60);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached())
    {
         // add item to the sitemap (url, date, priority, freq)
         $sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
       //  $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

         // add item with translations (url, date, priority, freq, images, title, translations)
         $translations = [
                           ['language' => 'fr', 'url' => URL::to('pageFr')],
                           ['language' => 'de', 'url' => URL::to('pageDe')],
                           ['language' => 'bg', 'url' => URL::to('pageBg')],
                         ];
         $sitemap->add(URL::to('pageEn'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly', [], null, $translations);

         // add item with images
        // $images = [
      //      ['url' => URL::to('images/pic1.jpg'), 'title' => 'Image title', 'caption' => 'Image caption', 'geo_location' => 'Plovdiv, Bulgaria'],
         //            ['url' => URL::to('images/pic2.jpg'), 'title' => 'Image title2', 'caption' => 'Image caption2'],
         //            ['url' => URL::to('images/pic3.jpg'), 'title' => 'Image title3'],
         //          ];
         $sitemap->add(URL::to('/'), '2015-06-24T14:30:00+02:00', '0.9', 'monthly');

         // get all posts from db
         $posts = DB::table('visited')->orderBy('visited_at', 'desc')->get();

         // add every post to the sitemap
         foreach ($posts as $post)
         {
            $sitemap->add($post->url);
         }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});

Route::get('/country-search', 'MainController@searchCountry');

//Route::get('search-results/{arr}','MainController@getSearchResults');

Route::get('/', 'MainController@home');
Route::get('/visited/seemore/{limit}', 'MainController@seemore');


Route::get('{place}/{type}/{country}/{countryCode}/{latitude}/{longitude}', 'MainController@getPlace');
Route::get('see-more/{country}', 'MainController@ajaxSeeMore');

Route::get('{lang}/redirect/{place}', 'MainController@redirectToPlace');
//Route::get('{lang}/place-view/{type}/{place}', 'MainController@countryView');

//contact
Route::get('contact-us', 'MainController@contactUs');

Route::post('send-message', 'MainController@sendMessage');

// About
Route::get('about-us', 'MainController@about');

//  Articles
Route::get('article/{id}', 'MainController@getArticle');
Route::get('all-articles', 'MainController@allArticles');

// Rss
Route::get('rss', 'MainController@getRss');

// Rss with soly
Route::get('siterss', 'MainController@demo');

// Site map
Route::get('site-map', 'MainController@getSiteMap');

// Terms
Route::get('terms', 'MainController@getTerms');

// Last Visited places
Route::get('last-visited-places', 'MainController@lastVisitedPlaces');


// SetLocale
Route::get('set-lang/{lang}', 'MainController@setLang');
Route::get('set2-lang-2/{lang}/{place}', 'MainController@setLang2');


Route::get('/{lang}', function ($segment) {
    $languages = ['ar', 'de', 'es', 'fr', 'hi', 'ja', 'pt', 'ru', 'tr', 'zh'];
    if (in_array($segment, $languages)) {
        return redirect("http://$segment.infotheworld.com");
    } else {
        if ($segment == 'en') {
            return redirect("http://infotheworld.com");
        } else {
            return redirect(route($segment));
        }
    }
});

/*
|--------------------------------------------------------------------------
|Admin Routes
|--------------------------------------------------------------------------

|
*/

Route::get('admin/home', 'AdminController@home');
//Route::get('admin/add', 'AdminController@addAdmin');

Route::get('admin/login', 'AdminLogin@login');
Route::post('admin/login', 'AdminLogin@loginPost');
Route::get('admin/logout', 'AdminLogin@logout');

//Home Text section
Route::get('admin/add-home-section', 'AdminController@addHometext');
Route::get('admin/get-home-secton-content/{lang}', 'AdminController@getHomeSectionContent');
Route::post('admin/add-home-section', 'AdminController@addHomeSectionPost');


//Countries / states /cities
Route::get('admin/places-view', 'AdminController@getCountriesData');
Route::get('admin/place-view/{place}', 'AdminController@placeData');
Route::get('admin/place-textEdit/{place}', 'AdminController@placeTextEdit');
Route::post('admin/place-textEdit/{place}', 'AdminController@placeTextEditPost');
Route::post('admin/dlt-place-image', 'AdminController@deletePlaceImg');
Route::get('admin/upload-image-to/{place}', 'AdminController@uploadImage');
Route::post('admin/upload-image-to/{place}', 'AdminController@uploadImagePost');
Route::get('admin/dlt-uploaded-img/{id}', 'AdminController@deleteImage');


// about

Route::get('admin/add-about', 'AdminController@addAbout');
Route::post('admin/add-about', 'AdminController@addAboutPost');
Route::get('admin/get-about-content/{locale}', 'AdminController@getAboutContent');

// Contacts
Route::get('admin/contacts', 'AdminController@getContacts');
Route::get('admin/reply/{id}', 'AdminController@reply');
Route::post('admin/reply/{id}', 'AdminController@replyPost');
Route::get('admin/dlt-contact/{id}', 'AdminController@deleteContact');

// Settings
Route::get('admin/edit-title-content', 'AdminController@editTitleEmail');
Route::post('admin/update-title-email', 'AdminController@editTitleEmailPost');
Route::get('admin/edit-metaDesc', 'AdminController@editMetaDesc');
Route::post('admin/update-metaDesc', 'AdminController@editMetaDescPost');
Route::get('admin/edit-metakeywords', 'AdminController@editMetaKeywords');
Route::post('admin/update-metaKeywords', 'AdminController@editMetaKeywordsPost');
Route::get('admin/edit-country-metaDesc', 'AdminController@countryMetaDesc');
Route::post('admin/edit-country-metaDesc', 'AdminController@countryMetaDescPost');
Route::get('admin/edit-country-metaKey', 'AdminController@countryMetaKey');
Route::post('admin/edit-country-metaKey', 'AdminController@countryMetaKeyPost');
Route::get('admin/get-meta-content/{locale}', 'AdminController@getMetaContent');
Route::get('admin/get-meta-key-content/{locale}', 'AdminController@getMetaKeyContent');
Route::get('admin/get-country-meta-desc-content/{locale}', 'AdminController@getCountryMetaDescContent');
Route::get('admin/get-country-meta-key-content/{locale}', 'AdminController@getCountryMetaKeyContent');

//Ads
Route::get('admin/add-ad', 'AdminController@addAd');
Route::post('admin/add-ad-post', 'AdminController@addAdPost');
Route::get('admin/ads-rows', 'AdminController@getAdsRows');
Route::get('admin/dlt-ad/{id}', 'AdminController@deleteAd');

// ADD DAta
Route::get('admin/add-data', 'AdminController@addData');

// Articles
Route::get('admin/add-article', 'AdminController@addArticle');
Route::post('admin/add-article', 'AdminController@addArticlePost');
Route::get('admin/get-articles', 'AdminController@getArticles');
Route::get('admin/get-article/{id}', 'AdminController@getArticle');
Route::get('admin/dlt-article/{id}', 'AdminController@deleteArticle');
Route::get('admin/edit-article/{id}', 'AdminController@editArticle');
Route::post('admin/edit-article/{id}', 'AdminController@editArticlePost');

// Terms
Route::get('admin/add-terms', 'AdminController@addTerms');
Route::post('admin/add-terms', 'AdminController@addTermsPost');
Route::get('admin/get-terms', 'AdminController@getTerms');
Route::get('admin/edit-terms/{id}', 'AdminController@editTerms');
Route::get('admin/dlt-terms/{id}', 'AdminController@deleteTerms');


// users
Route::get('admin/add-new-user', 'AdminController@addNewUser');
Route::post('admin/add-new-user', 'AdminController@addNewUserPost');
Route::get('admin/get-all-users', 'AdminController@getAllUsers');
Route::get('admin/dlt-user/{id}', 'AdminController@deleteUser');

// get DATA
Route::get("get-data/{lang}", 'MainController@getData');
Route::get('admin/fix-data', 'AdminController@fixData');


// archive
Route::get('admin/archive', 'AdminController@archive');

Route::post('admin/archive', 'AdminController@postArchive');
Route::post('admin/archive/states', 'AdminController@postArchiveState');

Route::post('admin/archive/cities', 'AdminController@postArchiveCity');

Route::post('admin/archive/archivstat', 'AdminController@postArchiveStates');

Route::post('admin/archive/archivcity', 'AdminController@postArchiveCities');

// see archived
Route::get('admin/archive/seearchives', 'AdminController@seeArchive');



