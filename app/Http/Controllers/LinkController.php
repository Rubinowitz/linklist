<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Auth;
    use App\Link;

class LinkController extends Controller
{
    public function index()
    {
        $links = \App\Link::all();
        $user = Auth::user();
        return view('welcome',compact('user'), ['links' => $links]);
    }

    public function add()
    {
        return view('add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $link = new Link();
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->user_id = Auth::id();
        $link->save();
        return redirect('/');
    }

    public function edit(Link $link)
    {

        if (Auth::check() && Auth::user()->id == $link->user_id)
        {
            return view('edit', compact('link'));
        }
        else {
            return redirect('/');
        }
    }

    public function update(Request $request, Link $link)
    {
        if(isset($_POST['delete'])) {
            $link->delete();
            return redirect('/');
        }
        else
        {
            $link->description = $request->description;
            $link->save();
            return redirect('/');
        }
    }
}
