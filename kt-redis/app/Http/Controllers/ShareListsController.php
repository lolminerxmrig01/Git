<?php

namespace App\Http\Controllers;
use App\User;
use App\Catalog;
use App\ShareLists;
use Illuminate\Http\Request;
use Auth;

class ShareListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::user()->is_admin == 1){
			$users = User::where('id', '!=', Auth::user()->id)->get();
			return view('share-lists.index', compact('users'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		ShareLists::where('user_id',$request['user_id'])->delete();	
		$lists = $request['saveuserlists'];
		
		foreach($lists as $list){
			$insertData[] = array('user_id' => $request['user_id'], 'catalog_id'=> $list);
		}
		
		ShareLists::insert($insertData);
		return redirect()->route('share-lists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$suser = User::where('id', '=', $id)->first();
        $catalogs = Catalog::withCount(['leads'])->get();
		$userlists = ShareLists::where('user_id', '=', $id)->get();
		$lists = array();
		foreach($userlists as $userlist){
			$lists[] = $userlist->catalog_id;
		}
		
		return view('share-lists.show', compact('suser','catalogs','lists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
