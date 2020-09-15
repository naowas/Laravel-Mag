<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Settings;
use Illuminate\Support\Facades\DB;

class frontController extends Controller
{

    public function __construct()
    {
        $categories = Category::where('status', 'ON')->get();
        $settings = Settings::limit(1)->orderBy('id', 'desc')->get();
        $a = Settings::orderBy('id', 'desc')->pluck('social');
        $a = explode(',', $a);
        $a = str_replace(array('[', ']', '"', '\\'), '', $a);

        $ico = Settings::orderBy('id', 'desc')->pluck('social');
        foreach($a as $social){
            $icon = explode('.',$social);
           // $icon = str_replace(array('[', ']',',', '"', '\\'), '', $a);

            $icon = $icon[1];
            $icons[] = $icon;
        }

        view()->share([
            'categories' => $categories,
            'settings' => $settings,
            'a' => $a,
            'icons' => $icons,
        ]);
    }

    public function index()
    {
        $featured = DB::table('posts')->where('category_id', 'like', '%9%' )->orderBy('id','desc')->get();
        $generel = DB::table('posts')->where('category_id', 'like', '%10%' )->orderBy('id','desc')->get();
        $business = DB::table('posts')->where('category_id', 'like', '%2%' )->orderBy('id','desc')->get();
        $sports = DB::table('posts')->where('category_id', 'like', '%5%' )->orderBy('id','desc')->get();
        $technology = DB::table('posts')->where('category_id', 'like', '%4%' )->orderBy('id','desc')->get();
        $health = DB::table('posts')->where('category_id', 'like', '%8%' )->orderBy('id','desc')->get();
        $travel = DB::table('posts')->where('category_id', 'like', '%6%' )->orderBy('id','desc')->get();
        $entertainment = DB::table('posts')->where('category_id', 'like', '%3%' )->orderBy('id','desc')->get();
        $politics = DB::table('posts')->where('category_id', 'like', '%1%' )->orderBy('id','desc')->get();
        $style = DB::table('posts')->where('category_id', 'like', '%7%' )->orderBy('id','desc')->get();
        return view('frontend.index',compact('featured','generel','business','sports','technology','health','travel',
        'entertainment','politics','style'));
    }
    public function more_news()
    {
        $business = DB::table('posts')->where('category_id', 'like', '%2%' )->orderBy('id','desc')->get();
        $health = DB::table('posts')->where('category_id', 'like', '%8%' )->orderBy('id','desc')->get();
        return view('frontend.more_news',compact('business','health'));
    }


    public function category($slug)
    {
        $cat = DB::table('categories')->where('slug', $slug)->first();
        $posts = DB::table('posts')->where('category_id', 'like', '%'.$cat->id.'%')->get();
        $business = DB::table('posts')->where('category_id', 'like', '%2%')->orderBy('id', 'desc')->get();

        $health = DB::table('posts')->where('category_id', 'like', '%8%')->orderBy('id', 'desc')->get();

        return view('frontend.category',compact('cat','posts','health','business'));

    }
    public function article($slug)
    {
        $business = DB::table('posts')->where('category_id', 'like', '%2%')->orderBy('id', 'desc')->get();
        $health = DB::table('posts')->where('category_id', 'like', '%8%')->orderBy('id', 'desc')->get();

        // $single_post = DB::table('posts')->where('slug',$slug)->first();
        $single_post = Post::where('slug',$slug)->first();
        $related_post = DB::table('posts')->where('category_id', 'like', '%'.$single_post->category_id.'%')->get();

        return view('frontend.article',compact('single_post','business','health','related_post'));

    }
}
