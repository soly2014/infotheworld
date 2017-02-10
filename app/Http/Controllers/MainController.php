<?php
namespace App\Http\Controllers;
use App\Ad;
use App\Article;
use App\Contact;
use App\Setting;
use App\Term;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;
use App\Http\Requests\GetCountryPageRequest;
use App\Http\Requests\ContactRequest;
use App\Country;
use App\About;
use View;
use App\Country2;
use App\State;
use App\City;
use App\DataImage;
use App\DataText;
use Yangqi\Htmldom\Htmldom;
use App\CountryPhone;
use App\UploadImage;
use App\visit;
use App\HomeText;
use Response,DB;

class MainController extends Controller
{

    public function __construct()
    {


        $about = About::where('locale', Session::get('locale'))->first();

        $siteTitle = Setting::where('title', 'title')->first();
        $ad1 = Ad::where("place", 1)->orderBy('id', 'DESC')->first();
        $ad2 = Ad::where("place", 2)->orderBy('id', 'DESC')->first();
        $ad3 = Ad::where("place", 3)->orderBy('id', 'DESC')->first();
        $ad4 = Ad::where("place", 4)->orderBy('id', 'DESC')->first();

        View::share([
            'about' => $about,
            'siteTitle' => $siteTitle,
            'ad1' => $ad1,
            'ad2' => $ad2,
            'ad3' => $ad3,
            'ad4' => $ad4,
        ]);

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
    }

    public function index()
    {

        if (Session::has('locale')) {
            $language = Session::get('locale');
        } else {
            $language = 'en';
        }
        return redirect(action('MainController@home', $language));

    }

    public function seemore($limit)
    {
        $visited = visit::where('locale', Session::get('locale'))
        ->orderBy('id', 'DESC')->take(20)->skip($limit)->get();
        return Response::json($visited, 200);
    }

    public function home()
    {
        ini_set('max_execution_time', 300);
//        dd($lang);
        $ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $location = Location::get();
        $homeText = HomeText::where('lang', App::getLocale())->first();
        $visited = visit::where('locale', Session::get('locale'))->orderBy('id', 'DESC')->take(20)->get();

        $geoArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));

        $meta_desc = Setting::where([
            'title' => 'meta_desc',
            'lang' => App::getLocale(),
        ])->first();
        $meta_keywords = Setting::where([
            'title' => 'meta_keywords',
            'lang' => App::getLocale(),
        ])->first();

        $articles = Article::where('locale', App::getLocale())->take(8)->orderBy('id', 'DESC')->get();


//        return view('pages.home')->with([
//            'title' => trans('trans.home'),
//            'lat' => $location->latitude,
//            'lng' => $location->longitude,
//            'ip' => $location->ip,
//            'country' => $location->countryName,
//            'visited' => $visited,
//            'homeText' => $homeText,
//            'meta_desc' => $meta_desc,
//            'meta_keywords' => $meta_keywords,
//            'articles' => $articles
//        ]);

        return view('pages.home')->with([
            'title' => trans('trans.home'),
            'ip' => $geoArray['geoplugin_request'],
            'lat' => $geoArray['geoplugin_latitude'],
            'lng' => $geoArray['geoplugin_longitude'],
            'country' => $geoArray['geoplugin_countryName'],
            'countryCode' => $geoArray['geoplugin_countryCode'],
            'visited' => $visited,
            'homeText' => $homeText,
            'meta_desc' => $meta_desc,
            'meta_keywords' => $meta_keywords,
            'articles' => $articles,
        ]);
    }



//////////////////////////////////////////////////////////////////////////////////////////////


    public function getPlace($place, $type, $country, $countryCode, $lat, $lng,Request $request )
    {
        if (!DB::table('visited')->where('place',$country)->first()) {
            DB::table('visited')->insertGetId(['place'=>$country,'url'=>$request->fullUrl(),
            'locale'=>App::getLocale()]);
        }
        
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '-1');

//        App::setLocale($lang);

        $lat = str_replace('_', '.', $lat);
        $lng = str_replace('_', '.', $lng);

        $classVisit = new visit();
        $place = str_replace("_", " ", $place);
        $country = str_replace("_", " ", $country);


        $country2 = Country2::where('sortname', strtoupper($countryCode))->first();
        $uploadedImages = UploadImage::where('place', $place)->get();


        $country_metaDesc = Setting::where([
            'title' => 'country_metaDesc',
            'lang' => App::getLocale(),
        ])->first();
        $country_metaKey = Setting::where([
            'title' => 'country_metaKey',
            'lang' => App::getLocale(),
        ])->first();


        if (strlen($countryCode) == 2) {
            $phoneCode = CountryPhone::where('iso', strtoupper($countryCode))->first();
            View::share([
                'phoneCode' => $phoneCode->phonecode,
            ]);
        }


        $placeArticle = Article::where('place', $place)->orderBy('id', 'DESC')->first();

        if ($country2) {
            $states = State::where('country_id', $country2->id)->get();
        }
        if (isset($states)) {
            foreach ($states as $state) {
                $cities[] = City::where('state_id', $state->id)->get();
            }
            $geoArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
            $flag = Country::where('alpha_2', strtolower($countryCode))->first();
            return view('pages.country')->with([
                'title' => $country . '-' . $place,
                'country' => $place,
                'country2' => $country,
                'countryCode' => $countryCode,
                'lat' => $lat,
                'lng' => $lng,
                'type' => $type,
                'ip' => $geoArray['geoplugin_request'],
                'flag' => $flag,
                'states' => $states,
                'cities' => $cities,
                'dataImage' => new DataImage(),
                'dataText' => new DataText(),
                'uploadedImages' => $uploadedImages,
                'classVisit' => $classVisit,
                'country_metaDesc' => $country_metaDesc,
                'country_metaKey' => $country_metaKey,
                'placeArticle' => $placeArticle

            ]);

        }


//        dd($cities);
        $geoArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        $flag = Country::where('alpha_2', strtolower($countryCode))->first();
        return view('pages.country')->with([
            'title' => $country . '-' . $place,
            'country' => $place,
            'country2' => $country,
            'countryCode' => $countryCode,
            'lat' => $lat,
            'lng' => $lng,
            'type' => $type,
            'ip' => $geoArray['geoplugin_request'],
            'flag' => $flag,
            'dataImage' => new DataImage(),
            'dataText' => new DataText(),
            'uploadedImages' => $uploadedImages,
            'classVisit' => $classVisit,
            'country_metaDesc' => $country_metaDesc,
            'country_metaKey' => $country_metaKey,
            'placeArticle' => $placeArticle

        ]);
    }

//    public function countryView(GetCountryPageRequest $request)
//    {
//        ini_set('max_execution_time', 300);
//        ini_set('memory_limit', '-1');
//
//        $country = Country2::where('sortname', strtoupper($request->input('cC')))->first();
//        $uploadedImages = UploadImage::where('place', $request->input('cN'))->get();
//
//        if (strlen($request->input('cC')) == 2) {
//            $phoneCode = CountryPhone::where('iso', strtoupper($request->input('cC')))->first();
//            View::share([
//                'phoneCode' => $phoneCode->phonecode,
//            ]);
//        }
//
//
//        if ($country) {
//            $states = State::where('country_id', $country->id)->get();
//
//        }
//        if (isset($states)) {
//            foreach ($states as $state) {
//                $cities[] = City::where('state_id', $state->id)->get();
//            }
//            $geoArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
//            $flag = Country::where('alpha_2', strtolower($request->input('cC')))->first();
//            return view('pages.country')->with([
//                'title' => $request->input('cN2') . '-' . $request->input('cN'),
//                'country' => $request->input('cN'),
//                'country2' => $request->input('cN2'),
//                'countryCode' => $request->input('cC'),
//                'lat' => $request->input('lat'),
//                'lng' => $request->input('lng'),
//                'type' => $request->input('type'),
//                'ip' => $geoArray['geoplugin_request'],
//                'flag' => $flag,
//                'states' => $states,
//                'cities' => $cities,
//                'dataImage' => new DataImage(),
//                'dataText' => new DataText(),
//                'uploadedImages' => $uploadedImages
//
//            ]);
//
//        }
//
//
////        dd($cities);
//        $geoArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
//        $flag = Country::where('alpha_2', strtolower($request->input('cC')))->first();
//        return view('pages.country')->with([
//            'title' => $request->input('cN2') . '-' . $request->input('cN'),
//            'country' => $request->input('cN'),
//            'country2' => $request->input('cN2'),
//            'countryCode' => $request->input('cC'),
//            'lat' => $request->input('lat'),
//            'lng' => $request->input('lng'),
//            'type' => $request->input('type'),
//            'ip' => $geoArray['geoplugin_request'],
//            'flag' => $flag,
//            'dataImage' => new DataImage(),
//            'dataText' => new DataText(),
//            'uploadedImages' => $uploadedImages
//
//
//        ]);
//    }

    public function redirectToPlace($lang, $place)
    {
        Session::set('locale', $lang);


        return view('pages.redirect')->with([
            'title' => 'redirect',
            'lang' => $lang,
            'place' => $place
        ]);
    }

    public function sendMessage(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        $contact->date = date("Y-m-d h:i a");
        $save = $contact->save();

        if ($save) {
            return redirect(action('MainController@contactUs'))->with('success', 'تم ارسال الرساله بنجاح');
        }
    }

    public function ajaxSeeMore($country)
    {
        $place = DataText::where('place', $country)->first();
        $text = $place->text;
        return $text;
    }

    public function setLang($lang)
    {
        Session::set('locale', $lang);
//        App::setLocale($lang);
        return redirect()->back();
    }

    public function setLang2($lang, $place)
    {
        Session::set('locale', $lang);
        return redirect("$lang/redirect/$place");
    }

    //////////////////////////////////////////////////

    public function contactUs()
    {
        return view('pages.contactus')->with([
            'title' => trans('trans.contact')
        ]);
    }

    public function about()
    {

        $about = About::where('locale', App::getLocale())->first();
        return view('pages.about')->with([
            'title' => trans('trans.about'),
            'about' => $about
        ]);
    }

    public function getArticle($id)
    {

        $article = Article::where('id', $id)->first();
        $articles = Article::orderBy('id', 'DESC')->where('locale', App::getLocale())->take(5)->get();


        return view('pages.article')->with([
            'title' => $article->title,
            'article' => $article,
            'articles' => $articles,
            'Visit' => new visit(),
        ]);
    }

    public function allArticles()
    {
        $articles = Article::orderBy('id', 'DESC')->where('locale', App::getLocale())->paginate(8);

        return view('pages.allarticles')->with([
            'title' => trans('trans.all articles'),
            'articles' => $articles
        ]);

    }

    public function getRss()
    {

        $places = visit::where('locale', Session::get('locale'))->orderBy('id', 'DESC')->get();
        $articles = Article::orderBy('id', 'DESC')->where('locale', App::getLocale())->get();

        return view('pages.rss')->with([
            'title' => 'rss',
            'places' => $places,
            'articles' => $articles
        ]);
    }

    public function getSiteMap()
    {
        $places = visit::where('locale', Session::get('locale'))->orderBy('id', 'DESC')->take(10)->get();

        return view('pages.sitemap')->with([
            'places' => $places,
            'title' => trans('trans.site map')
        ]);
    }

    public function getTerms()
    {
        $terms = Term::where('lang', App::getLocale())->first();

        return view('pages.terms')->with([
            'title' => trans('trans.terms'),
            'terms' => $terms
        ]);
    }

    public function lastVisitedPlaces()
    {
        $places = visit::where('locale', Session::get('locale'))->orderBy('id', 'DESC')->paginate(5000);

        return view('pages.lastvisitedplaces')->with([
            'title' => trans('trans.last visited places'),
            'places' => $places
        ]);
    }


    public function getData($lang)
    {
        $countries = Country::all();
        $states = State::all();
        return view('pages.getdata')->with([
            'title' => 'get data',
            'countries' => $countries,
            'states' => $states,
            'lang' => $lang
        ]);
    }


    ////////////////////////////////////////////////////////////////////////

    public function searchCountry(Request $request)
    {
    
        // Gets the query string from our form submission 
        $query = trim($request->searchcountry);

        $array = explode(" ",$query);

        $locale = app()->getLocale();

            if ($locale == "en") {
                
                $name = 'name';
            }else{

                $name = $locale.'_name';
            }

        $place = [];
        $states = [];
        $cities = [];
        $articles = [];

            foreach ($array as $value) {

               $place[] = DB::table('countries')->where($name, $value)->first();
               $states[] = DB::table('states')->where($name, $value)->first();
               $cities[] = DB::table('cities')->where($name, $value)->first();
               $articles[] = DB::table('articles')->where('title', $value)->where('locale',$locale)->first();
//          $article = \App\Article::where('title', 'LIKE', '%'.$query.'%')->get();

            }

          /* remove null values from an array */
          $nulless = array_filter($place, function($var){
                   return !is_null($var);
                });

          /* remove null values from an array */
          $nullstate = array_filter($states, function($var){
                   return !is_null($var);
                });

          /* remove null values from an array */
          $nullcity = array_filter($cities, function($var){
                   return !is_null($var);
                });


          /* remove null values from an array */
          $nullarticle = array_filter($articles, function($var){
                   return !is_null($var);
                });


         $arr = [];
         $cit = [];
         $stat = [];
         $article = [];
         /* if there are results from search  */
         if (!empty($nulless)) {
          
            foreach ($nulless as $key => $value) {
                
                $arr[] = $value->name;
            }
         } 
          
         /* if there are results from search  */
         if (!empty($nullarticle)) {
          
            foreach ($nullarticle as $key => $value) {
                
                $article[] = $value->title;
            }
         } 
          

         if (!empty($nullstate)) {

            foreach ($nullstate as $key => $value) {
                
                $stat[] = $value->name;
            }
        }


        if (!empty($nullcity)) {
          
            foreach ($nullcity as $key => $value) {
                
                $city[] = $value->name;
            }

        }    


             return view('pages.search-results')->with('title','search-results')
                                               ->with('arr',$arr)         
                                               ->with('stat',$stat)         
                                               ->with('cit',$cit)         
                                               ->with('locale',$locale)         
                                               ->with('name',$name)         
                                               ->with('articles',$article);         




    }


    //////////////////////////////////////////////////////////////////////////////////////////

    public function demo() {
    
    $feed = \Feeds::make(url('all_countries'));
    $data = array(
      'title'     => $feed->get_title(),
      'permalink' => $feed->get_permalink(),
      'items'     => $feed->get_items(),
    );

    return view('feed', $data);
  }


}
