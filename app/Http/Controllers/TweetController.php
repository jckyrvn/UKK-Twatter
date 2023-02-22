<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TweetController extends Controller
{
    public function create(Request $request){
        $format_media = "";
        $today = Carbon::now();

        $validator = Validator::make($request->all(), [
            "tweet"=>"required",
            "id"=>"required",
        ]);
        if($validator->fails()){
            return response()->json(["error"=>"unauthorized"], 400);
        }

        if($request->hasFile('media')) {
            $storage = Storage::disk('tweet_media');
            $tweet_media = $today->format('Ymd_Hms') . '_' . Str::random(12) . '_' . '.' . $request->file('media')->getClientOriginalExtension();
            $storage->putFileAs(null , $request->file('media') , $tweet_media, []);
        }

        $split_tweet = explode("#" , $request->tweet);
    $slices_tweet = array_slice($split_tweet,1,count($split_tweet) - 1);
    $tag = implode('', $slices_tweet);
    
        $created = Tweet::create([
            'tag'=>$tag,
            'tweet'=>$split_tweet[0],
            'media'=>$tweet_media,
            'user_id'=>Auth::user()->id,
        ]);
        
        return response()->json([$split_tweet, 200]);
    }

    public function comment(Request $request)
    {
        $create = Comment::create([
            'comments'=> $request->comments,
            'tweet_id'=> $request->id,
            'user_id'=>Auth::user()->id,
        ]);

        $comment =  Comment::latest()->first();
        $comment_id = $comment->tweet_id;
        if($create){
            return redirect()->route('main.comment', [
                'id' => $comment_id,
            ]);
        }
    }
    public function update(Request $request)
    {
        $format_media = "";
        $today = Carbon::now();
        if($request->hasFile('media_update')) {
            $storage = Storage::disk('tweet_media');
            $format_media = $today->format('Ymd_Hms') . '_' . Str::random(12) . '_' . '.' . $request->file('media_update')->getClientOriginalExtension();
            $storage->putFileAs(null , $request->file('media_update') , $format_media, []);
        }

        $update = Tweet::find($request->id_update);
        $update->tweet=$request->tweet_update;
        $update->media=$format_media;
        $update->save();
        
        
        return response()->json(['status' => true, 'data' => $update]);
    }

    public function delete(Request $request){
        $findtweet = Tweet::where("id", $request->id);
        if($findtweet){
            $findtweet->delete();
            return redirect()->route('welcome');
        }
    }

    public function updateComment(Request $request)
    {
        $update = Comment::find($request->id_update);
        $update->comment=$request->tweet_update;
        $update->save();
        return response()->json(['status' => true, 'data' => $update]);
    }


//     public function search(Request $request) {
// 		// Get the search value from the request
//         $search = $request->input('search');

//         // Search in the title and body columns from the posts table
//         $tweet = User::query()
//             ->where('name', 'LIKE', "%{$search}%")
//             ->orWhere('username', 'LIKE', "%{$search}%")
//             ->get();
    
//         // Return the search view with the resluts compacted
//         return view('welcome', compact('welcome'));
// }
}
