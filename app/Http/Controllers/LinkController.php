<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use App\Link;
use Validator;


class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $links = \App\Link::all();
        $user = Auth::user();
        return view('links.index', compact('user'), ['links' => $links]);
    }

    public function create()
    {
        return view('links.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:links',
            'url' => 'required|url|unique:links',
            'description' => 'required|max:255',
        ]);

        $link = new Link();
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->user_id = Auth::id();
        $link->save();
        return redirect('/links');


    }

    public function edit(Link $link)
    {

        if (Auth::check() && Auth::user()->id == $link->user_id) {
            return view('links.edit', compact('link'));
        } else {
            return redirect('/links');
        }
    }

    public function update(Request $request, Link $link)
    {
        $this->validate($request, [
            'title' => [
                'required',
                'max:255',
                Rule::unique('links')->ignore($link->title, 'title'),
            ],
            'url' => [
                'required',
                'url',
                Rule::unique('links')->ignore($link->url, 'url'),
            ],
            'description' => 'required|max:255',
        ]);

        $link->description = $request->description;
        $link->save();
        session()->flash('status', 'Link updated successfully');
        return redirect('/links');
    }

    public function destroy(Request $request, Link $link)
    {
        $this->authorize('destroy', $link);

        $link->delete();

        session()->flash('status', 'Link deleted successfully');

        return redirect('/links');
    }
}
