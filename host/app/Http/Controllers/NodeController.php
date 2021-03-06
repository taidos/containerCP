<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::user()->role >= 1000) {
            return redirect('/dashboard');
        }
	if (\Auth::user()->role == 0) {
		$nodes = \App\Node::paginate(5);
	} else {
        	$nodes = \App\Node::where('owner', \Auth::id())->paginate(5);
	}
        return view('admin.nodes.view_nodes')->with('nodes', $nodes);
    }
}
