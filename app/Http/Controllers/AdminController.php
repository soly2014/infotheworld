<?php

namespace App\Http\Controllers;

use App\Ad;
use App\visit;
use Hamcrest\Core\Set;
use Illuminate\Cache\MemcachedConnector;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddAboutRequest;
use App\Http\Requests\ReplyRequest;
use App\Http\Requests\UpdateTitleEmailRequest;
use App\Http\Requests\UpdateMetaDescRequest;
use App\Http\Requests\UpdateMetaKeyWordsRequest;
use App\Http\Requests\DeletePlaceImgRequest;
use App\Http\Requests\AddAdRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Requests\AddHomeSectionRequest;
use App\Http\Requests\AddArticleRequest;
use App\Http\Requests\AddTermRequest;
use App\Http\Requests\AddNewUserRequest;
use App\User;
use App\About;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Setting;
use App\DataText;
use App\DataImage;
use App\Count;
use App\City;
use App\UploadImage;
use App\HomeText;
use App\Article;
use App\Term;
use App\Country;
use App\Country2;
use App\State;
use Auth;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('Admin', ['except' => [
            'editArticlePost', 'editArticle', 'getArticle',
             'getArticles', 'addArticlePost', 'addArticle','home'
        ]]);
    }

    public function home()
    {
        return view('admin.home')->with([
            'title' => 'home',

        ]);
    }

    // About
    public function addAbout()
    {
        return view('admin.addabout')->with([
            'title' => 'Add about',
        ]);
    }

    public function addAboutPost(AddAboutRequest $request)
    {
        $about = About::where('locale', $request->input('langCode'))->first();
        if (count($about) > 0) {
            $about->content = $request->input('content');
            $save = $about->save();
            if ($save) {
                return redirect()->back()->with('success', 'تم تحديث المحتوى بنجاح');
            }
        } else {
            $about = new About();
            $about->locale = $request->input('langCode');
            $about->content = $request->input('content');
            $save = $about->save();
            if ($save) {
                return redirect()->back()->with('success', 'تم اضافة المحتوى بنجاح');
            }
        }


    }

    public function getAboutContent($locale)
    {
        $about = About::where('locale', $locale)->first();
        return $about->content;
    }

    // Contacts
    public function getContacts()
    {
        $contacts = Contact::orderBy('id', 'DESC')->paginate(4);
        return view('admin.getcontacts')->with([
            'title' => 'contacts',
            'contacts' => $contacts
        ]);

    }

    public function reply($id)
    {
        $contact = Contact::where('id', $id)->first();

        return view('admin.reply')->with([
            'title' => 'reply',
            'contact' => $contact

        ]);
    }

    public function replyPost(ReplyRequest $request, $id)
    {

        $siteEmail = Setting::where('title', 'email')->first();
        $siteTitle = Setting::where('title', 'title')->first();
        $contact = Contact::where('id', $id)->first();

        $send = Mail::send('emails.reply', [
            'm' => $request->input('message'),
            'subject' => $request->input('subject'),
        ], function ($m) use ($contact, $request, $siteEmail, $siteTitle) {
            $m->from($siteEmail->content, $siteTitle->content);

            $m->to($contact->email, $contact->name)->subject($request->input('subject'));
        });

        if ($send) {
            return redirect()->back()->with('success', 'تم ارسال الرساله بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث شئ خاطئ اعد ارسال الرساله');
        }


    }

    public function deleteContact($id)
    {
        $delete = Contact::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        }
    }

    public function editTitleEmail()
    {
        $title = Setting::where('title', 'title')->first();
        $email = Setting::where('title', 'email')->first();

        return view('admin.edittitleemail')->with([
            'title' => 'Edit title & email',
            'tit' => $title,
            'email' => $email

        ]);
    }

    public function editTitleEmailPost(UpdateTitleEmailRequest $request)
    {
        $title = Setting::where('title', 'title')->first();
        $title->content = $request->input('title');
        $title->save();

        $email = Setting::where('title', 'email')->first();
        $email->content = $request->input('email');
        $email->save();

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function editMetaDesc()
    {
        $metaDesc = Setting::where('title', 'meta_desc')->first();

        return view('admin.editmetadesc')->with([
            'title' => 'update meta description',
            'metaDesc' => $metaDesc
        ]);
    }

    public function editMetaDescPost(UpdateMetaDescRequest $request)
    {
        $meta = Setting::where([
            'title' => 'meta_desc',
            'lang' => $request->input('lang')
        ])->first();
        if (count($meta) > 0) {
            $meta->title = 'meta_desc';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        } else {
            $meta = new Setting();
            $meta->title = 'meta_desc';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        }


        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function getMetaContent($lang)
    {
        $meta = Setting::where([
            'title' => 'meta_desc',
            'lang' => $lang
        ])->first();

        return $meta->content;
    }

    public function editMetaKeywords()
    {
        $metaKey = Setting::where('title', 'meta_keywords')->first();

        return view('admin.editmetakeywords')->with([
            'title' => 'update meta keywords',
            'metaKey' => $metaKey
        ]);
    }

    public function editMetaKeywordsPost(UpdateMetaKeyWordsRequest $request)
    {
        $meta = Setting::where([
            'title' => 'meta_keywords',
            'lang' => $request->input('lang')
        ])->first();
        if (count($meta) > 0) {
            $meta->title = 'meta_keywords';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        } else {
            $meta = new Setting();
            $meta->title = 'meta_keywords';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        }

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function getMetaKeyContent($lang)
    {
        $meta = Setting::where([
            'title' => 'meta_keywords',
            'lang' => $lang
        ])->first();

        return $meta->content;
    }

    public function countryMetaDesc()
    {
        $metaDesc = Setting::where('title', 'country_metaDesc')->first();
        return view('admin.editcountrymetadesc')->with([
            'title' => 'countey meta desc',
            'metaDesc' => $metaDesc,
        ]);
    }

    public function countryMetaDescPost(UpdateMetaDescRequest $request)
    {
        $meta = Setting::where([
            'title' => 'country_MetaDesc',
            'lang' => $request->input('lang')
        ])->first();

        if (count($meta) > 0) {
            $meta->title = 'country_MetaDesc';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        } else {
            $meta = new Setting();
            $meta->title = 'country_MetaDesc';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        }

        return redirect()->back()->with('success', 'تم تعديل المحتوى بنجاح');
    }

    public function getCountryMetaDescContent($lang)
    {
        $meta = Setting::where([
            'title' => 'country_MetaDesc',
            'lang' => $lang
        ])->first();

        return $meta->content;
    }

    public function countryMetaKey()
    {
        $metaKey = Setting::where('title', 'country_metaKey')->first();
        return view('admin.editcountrymetakey')->with([
            'title' => 'edit-country-metaKey',
            'metaKey' => $metaKey
        ]);

    }

    public function countryMetaKeyPost(UpdateMetaKeyWordsRequest $request)
    {

        $meta = Setting::where([
            'title' => 'country_metaKey',
            'lang' => $request->input('lang')
        ])->first();

        if (count($meta) > 0) {
            $meta->title = 'country_metaKey';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        } else {
            $meta = new Setting();
            $meta->title = 'country_metaKey';
            $meta->content = $request->input('content');
            $meta->lang = $request->input('lang');
            $meta->save();
        }
        return redirect()->back()->with('success', 'تم تعديل المحتوى بنجاح');
    }

    public function getCountryMetaKeyContent($lang)
    {
        $meta = Setting::where([
            'title' => 'country_metaKey',
            'lang' => $lang
        ])->first();

        return $meta->content;
    }

    public function getCountriesData()
    {
        $countriesText = DataText::orderBy('id', 'DESC')->get();
        $countriesImages = DataImage::orderBy('id', 'DESC')->get();

        return view('admin.countries')->with([
            'title' => 'countries / states / cities',
            'countriesText' => $countriesText,
            'countriesImages' => $countriesImages,
        ]);
    }

    public function placeData($place)
    {
        $placeText = DataText::where('place', $place)->first();
        $placeImages = DataImage::where('place', $place)->first();
        $uploadedImages = UploadImage::where('place', $place)->get();

        return view('admin.placedata')->with([
            'title' => "$place",
            'placeText' => $placeText,
            'placeImages' => $placeImages,
            'uploadedImages' => $uploadedImages
        ]);
    }

    public function placeTextEdit($place)
    {
        $place = DataText::where('place', $place)->first();
        return view('admin.placetextedit')->with([
            'title' => "$place->place edit",
            'place' => $place
        ]);
    }

    public function placeTextEditPost($place, UpdateMetaKeyWordsRequest $request)
    {
        $place = DataText::where('place', $place)->first();
        if (count($place) > 0) {
            $place->text = $request->input('content');
            $place->save();
            return redirect("/admin/place-view/$place->place")->with('success', 'تم تحديث المحتوى بنجاح');
        }
    }

    public function deletePlaceImg(DeletePlaceImgRequest $request)
    {
        $place_name = $request->input('img_place');
        $img_src = $request->input('img_src');

        $dataImages = DataImage::where('place', $place_name)->first();
        $imagesArray = explode(" ", $dataImages->images_src);

        $imageKey = array_search($img_src, $imagesArray);
        unset($imagesArray[$imageKey]);

        $imagesArray = array_values($imagesArray);
        $dataImages->images_src = implode(" ", $imagesArray);
        $dataImages->save();

        return redirect("/admin/place-view/$place_name")->with('success', 'تم حذف الصوره بنجاح');

    }

    public function uploadImage($place)
    {
        return view('admin.uploadimage')->with([
            'title' => 'upload image to ' . $place,
            'place' => $place
        ]);
    }

    public function uploadImagePost($place, UploadImageRequest $request)
    {
        $image_name = md5($request->file('image')->getClientOriginalName()) . '.' . $request->file('image')->getClientOriginalExtension();

        $move = $request->file('image')->move('public/assets/uploads/images', $image_name);
        if ($move) {
            $uploadImage = new UploadImage();
            $uploadImage->image = $image_name;
            $uploadImage->place = $place;
            $save = $uploadImage->save();
            if ($save) {
                return redirect()->back()->with('success', 'تم رفع الصوره بنجاح');
            }
        }
    }

    public function deleteImage($id)
    {
        $image = UploadImage::where('id', $id)->first();
        unlink($_SERVER['DOCUMENT_ROOT'] . "/public/assets/uploads/images/$image->image");
        $delete = UploadImage::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        }

    }

//ads
    public function addAd()
    {
        return view('admin.addadcode')->with([
            'title' => 'add ad',
        ]);
    }

    public function addAdPost(AddAdRequest $request)
    {
        $ad = new Ad();
        $ad->ad = $request->input('ad-code');
        $ad->place = $request->input('section');
        $save = $ad->save();
        if ($save) {
            return redirect()->back()->with('success', 'تم اضافة كود الاعلان بنجاح');
        }
    }

    public function getAdsRows()
    {
        $ads = Ad::orderBy('id', 'DESC')->get();

        return view('admin.getads')->with([
            'title' => 'ads',
            'ads' => $ads
        ]);
    }

    public function deleteAd($id)
    {
        $delete = Ad::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        }
    }


    // home text section
    public function addHometext()
    {
        return view('admin.addhometext')->with([
            'title' => 'add home text',
        ]);
    }

    public function getHomeSectionContent($lang)
    {
        $sectionData = HomeText::where('lang', $lang)->first();

        $data['title'] = $sectionData->title;
        $data['content'] = $sectionData->content;

        return $data;
    }

    public function addHomeSectionPost(AddHomeSectionRequest $request)
    {
        $row = HomeText::where('lang', $request->input('langCode'))->first();
        if (count($row) > 0) {
            $row->lang = $request->input('langCode');
            $row->title = $request->input('title');
            $row->content = $request->input('content');
            $row->save();
        } else {
            $row = new HomeText();
            $row->lang = $request->input('langCode');
            $row->title = $request->input('title');
            $row->content = $request->input('content');
            $row->save();
        }

        return redirect()->back()->with('success', 'تم تحديث القسم');

    }

//    Articles
    public function addArticle()
    {

        $dataText = DataText::all();
        return view('admin.addarticle')->with([
            'title' => 'اضافة مقاله',
            'dataText' => $dataText
        ]);
    }

    public function addArticlePost(AddArticleRequest $request)
    {
        $article = new Article();

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        if (Auth::user()->type == 0) {
            $article->users_id = Auth::user()->id;
        }

        $imageName = md5($request->file('image')->getClientOriginalName()) . '.' . $request->file('image')->getClientOriginalExtension();

        $request->file('image')->move('public/assets/articles_images', $imageName);

        $article->image = $imageName;
        $article->date = date("Y/m/d");
        $article->place = $request->input('place');
        $article->locale = $request->input('lang');
        $article->tags = $request->input('tags');

        $save = $article->save();
        if ($save) {
            return redirect()->back()->with('success', 'تم اضافة المقاله');
        }
    }

    public function getArticles()
    {
        $articles = Article::orderBy('id', 'DESC');
        if (Auth::user()->type == 0) {
            $articles = $articles->where('users_id',Auth::user()->id);
        }

        $articles = $articles->get();
        return view('admin.articles')->with([
            'title' => 'المقالات',
            'articles' => $articles
        ]);

    }

    public function getArticle($id)
    {
        $article = Article::where('id', $id);
        if (Auth::user()->type == 0) {
            $article = $article->where('users_id',Auth::user()->id);
        }

        $article = $article->first();
        if (!$article) {
            return redirect('/admin/home');
        }
        return view('admin.article')->with([
            'title' => $article->title,
            'article' => $article
        ]);
    }

    public function editArticle($id)
    {
        $dataText = DataText::all();
        $article = Article::where('id', $id);
        if (Auth::user()->type == 0) {
            $article = $article->where('users_id',Auth::user()->id);
        }

        $article = $article->first();
        if (!$article) {
            return redirect('/admin/home');
        }
        return view('admin.editarticle')->with([
            'title' => "تعديل $article->title",
            'article' => $article,
            'dataText' => $dataText
        ]);
    }

    public function editArticlePost($id, Request $request)
    {
        $article = Article::where('id', $id);
        if (Auth::user()->type == 0) {
            $article = $article->where('users_id',Auth::user()->id);
        }

        $article = $article->first();
        if (!$article) {
            return redirect('/admin/home');
        }

        $article->title = $request->input('title');
        $article->content = $request->input('content');

        if (!empty($request->file('image'))) {
            $imageName = md5($request->file('image')->getClientOriginalName()) . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move('public/assets/articles_images', $imageName);
            $article->image = $imageName;
        }

        $article->place = $request->input('place');
        $article->locale = $request->input('lang');
        $article->tags = $request->input('tags');

        $save = $article->save();
        if ($save) {
            return redirect()->back()->with('success', 'تم تعديل المقاله');
        }
    }

    public function deleteArticle($id)
    {
        if (Auth::user()->type == 0) {
            return redirect()->back()->with('success', 'لا يمكنك الحذف');
        }

        $article = Article::where('id', $id)->first();
        unlink($_SERVER['DOCUMENT_ROOT'] . "/public/assets/articles_images/$article->image");
        $delete = Article::where('id', $id)->delete();
        if ($delete) {
            return redirect(action('AdminController@getArticles'));
        }
    }


//    Terms
    public function addTerms()
    {
        return view('admin.addterms')->with([
            'title' => 'اضافة شروط استخدام'
        ]);
    }

    public function addTermsPost(AddTermRequest $request)
    {
        $terms = Term::where('lang', $request->input('lang'))->first();

        if (count($terms) > 0) {
            $terms->title = $request->input('title');
            $terms->content = $request->input('content');
            $terms->lang = $request->input('lang');
            $save = $terms->save();
        } else {
            $terms = new Term();
            $terms->title = $request->input('title');
            $terms->content = $request->input('content');
            $terms->lang = $request->input('lang');
            $save = $terms->save();
        }
        if ($save) {
            return redirect()->back()->with('success', 'تم الاضافه بنجاح');
        }
    }

    public function getTerms()
    {
        $terms = Term::orderBy('id', 'DESC')->get();
        return view('admin.terms')->with([
            'title' => 'شروط الاستخدام',
            'terms' => $terms
        ]);
    }

    public function editTerms($id)
    {
        $terms = Term::where('id', $id)->first();

        return view('admin.editterms')->with([
            'title' => 'تعديل شروط الاستخدام',
            'terms' => $terms
        ]);
    }

    public function deleteTerms($id)
    {
        $delete = Term::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        }
    }


    public function getData($lang)
    {
        $countries = Country::all();
        $states = State::all();
        return view('admin.getdata')->with([
            'title' => 'get data',
            'countries' => $countries,
            'states' => $states,
            'lang' => $lang
        ]);
    }

    public function fixData()
    {
        $places = visit::all();

        foreach ($places as $place) {
            $location = visit::where('id', $place->id)->first();
            $location->url = str_replace("localhost:8888", "infotheworld.com", $location->url);

            $location->save();
        }

        return redirect(action('AdminController@home'));
    }

//    Admin Users

    public function addNewUser()
    {
        return view('admin.addnewuser')->with([
            'title' => 'اضافة مشرف جديد',
        ]);
    }

    public function addNewUserPost(AddNewUserRequest $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->type = 0;

        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'تم اضافة مشرف جديد');
        }
    }

    public function getAllUsers()
    {
        $users = User::where('type', 0)->orderBy('id', 'DESC')->get();

        return view('admin.allusers')->with([
            'title' => 'جميع المشرفين',
            'users' => $users
        ]);


    }

    public function deleteUser($id)
    {
        $delete = User::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back();
        }
    }



    /////////////////////////////////////////////////////////////////////////////////////////

    public function archive()
    {
        
        return view('admin.archive')->with(['title' => 'home']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    public function postArchive(Request $request)
    {

        if($request->ajax())
        {
            if($request->has('country') && $request->input('lang'))
            {
                $countname = $request->countryName;
                $country = $request->country;    
                $lang    = $request->lang;
               // $countname = Country2::where('sortname',$country)->first();
                // $countname = $countname->name;
                   
                    if ($lang == 'en') {

                    $url = 'http://infotheworld.com/'.$countname.'/country/'.$countname.'/'.$country.'/'.$request->lat.'/'.$request->lng;
                    }else{

                    $url = 'http://'.$lang.'.infotheworld.com/'.$countname.'/country/'.$countname.'/'.$country.'/'.$request->lat.'/'.$request->lng;
                        
                    }
                    

                if(!visit::where('url',$url)->exists()){

                    $vis = new visit();
                    $vis->url = $url;
                    $vis->locale = $lang;
                    $vis->place = $countname;
                    $vis->save();

                    return response()->json(['success'=>'done']);
                         
                }

                return response()->json(['success'=>'false']);

            }
        }
    }
    
    //////////////////////////////////////////////////////////////////////////////////

    public function postArchiveState(Request $request)
    {
        $count_id = Country2::where('sortname',$request->country)->first()->id;
        $count_id = $count_id;
        $states = State::where('country_id',$count_id)->get();
        $data = view('admin.states',['states'=>$states])->render();
      
        if(!empty($data))
        {
        return response()->json($data);
        }else{
        return response()->json('false');
        }
    }

    /////////////////////////////////////////////////////////////////////////////////

    /* showing cities */
    public function postArchiveCity(Request $request)
    {
       // $state_id = State::where('id',$request->state)->first()->id;
        if($request->state == ""){

         return response()->json(['success'=>'statenull']);
        }

        if (count($request->state) > 1) {
            
         return response()->json(['success'=>'multistate']);

        }

        $cities = City::where('state_id',$request->state)->get();
        $data = view('admin.cities',['cities'=>$cities])->render();
      
        if(!empty($data))
        {
        return response()->json($data);
        }else{
        return response()->json('false');
        }
    }

    /////////////////////////////////////////////////////////////////////////////////

    public function postArchiveStates(Request $request)
    {
       
        if($request->ajax())
        {
            if($request->has('states') && $request->input('lang'))
            {

                $country = $request->country;    
                $lang    = $request->lang;
                $countname = Country2::where('sortname',$country)->first();
                $countname = $countname->name;

                $urls = [];
                $exist = 0;
                foreach ($request->states as $key => $value) {
                    
                    $st  = State::where('id',$value)->first()->name; 
                   
                    if ($lang == 'en') {

                    $url = 'http://infotheworld.com/'.$st.'/country/'.$countname.'/'.$country.'/'.$request->lat.'/'.$request->lng;
                    }else{

                    $url = 'http://'.$lang.'.infotheworld.com/'.$st.'/country/'.$countname.'/'.$country.'/'.$request->lat.'/'.$request->lng;
                        
                    }
                    
                    if(!visit::where('url',$url)->exists()){

                        $vis = new visit();
                        $vis->url = $url;
                        $vis->locale = $lang;
                        $vis->place = $st;
                        $vis->save();
                        $exist =1;

                    }

                    $urls = array_prepend($urls, $url);

                }

                if ($exist == 1) {
                    
                    return response()->json(['success'=>'done']);
                }else{

                    return response()->json(['success'=>'false']);
                }

/*                $urls_count = count($urls);
                dd(count(visit::whereIn('url',$urls)->get()));
                if (visit::whereIn('url',$urls)->get()) {

                    return response()->json(['success'=>'done']);
                }else{

                    return response()->json(['success'=>'false']);
                }
*/
            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////////

    public function postArchiveCities(Request $request)
    {
 
        if($request->ajax())
        {
            if($request->has('country') && $request->input('lang'))
            {

                $country = $request->country;    
                $lang    = $request->lang;
                $countname = Country2::where('sortname',$country)->first();
                $countname = $countname->name;
                $urls = [];
                $exist = 0;
                foreach ($request->cities as $key => $value) {

                    $st  = City::where('id',$value)->first()->name; 
                   
                    if ($lang == 'en') {

                    $url = 'http://infotheworld.com/'.$st.'/country/'.$countname.'/'.$country.'/'.$request->lat.'/'.$request->lng;
                    }else{

                    $url = 'http://'.$lang.'.infotheworld.com/'.$st.'/country/'.$countname.'/'.$country.'/'.$request->lat.'/'.$request->lng;

                    }
                    
                    if(!visit::where('url',$url)->exists()){

                        $vis = new visit();
                        $vis->url = $url;
                        $vis->locale = $lang;
                        $vis->place = $st;
                        $vis->save();
                        $exist =1;

                    }

                    $urls = array_prepend($urls, $url);

                }

                if ($exist == 1) {
                    
                    return response()->json(['success'=>'done']);
                }else{

                    return response()->json(['success'=>'false']);
                }

/*               $urls_count = count($urls);
                dd(count(visit::whereIn('url',$urls)->get()));
                if (visit::whereIn('url',$urls)->get()) {

                    return response()->json(['success'=>'done']);
                }else{

                    return response()->json(['success'=>'false']);
                }*/

            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////


    public function seeArchive()
    {
        $archived = Visit::orderBy('id','desc')->get();
        return view('admin.seearchived')->with([
            'title' => 'Archived',
            'archive' => $archived,

        ]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    public function addMulti(Request $request)
    {
        $name  = $request->link;
      
        if (empty($name)) {
            
          $name = $request->place;

        }

        $place = $request->place;

        $add   = \App\State::where('name',$place)->first();

        $add->de_name = $name;

        $add->save();

        return response()->json(['status'=>$name]);

    }

    /////////////////////////////////////////////////////////////////////////////////////////
}
