<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use News;
use NewsLike;
use NewsComment;
use Auth;

class NewsController extends Controller
{
    public function like($id) {
        $new = News::find($id);
        $newLike = NewsLike::where('newId', $new->id)->where('userId', Auth::user()->id)->count();

        if($new == null) {
            return abort(404);
        }

        if($newLike > 0) {
            return abort(403);
        }

        NewsLike::create([
            'newId' => $id,
            'userId' => Auth::user()->id,
        ]);

        return redirect()->route('new', ['id' => $new->id]);
    }

    public function comment(Request $request, $id) {
        $new = News::find($id);

        if($new == null) {
            return abort(404);
        }

        $request->validate([
            'text' => ['required', 'max:500'],
        ]);

        NewsComment::create([
            'newId' => $id,
            'userId' => Auth::user()->id,
            'text' => $request->input('text'),
        ]);

        return redirect()->route('new', ['id' => $new->id]);
    }
}
