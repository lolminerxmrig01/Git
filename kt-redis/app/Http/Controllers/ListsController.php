<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\ShareLists;
use App\Http\Requests\ListsControllerStoreRequest;
use App\Http\Requests\ListStoreRequest;
use App\Services\CarrierBreakdownService;
use Illuminate\Http\Request;
use Auth;

class ListsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$ulists = array();
		$elist = array();
		$userlists = ShareLists::where('user_id', '=', Auth::user()->id)->get();
		if($userlists){
			foreach($userlists as $userlist){
				$elist[] = $userlist->catalog_id;
			}
			
			$ulists = Catalog::whereIn("id",$elist)->withCount(['leads'])->get();
		}
		
        $lists = auth()->user()->team->catalogs()->withCount(['leads'])->get();

        return view('lists.index', compact('lists','ulists'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\List $list
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Catalog $list)
    {
        $leads = $list->leads()->paginate(20);
        $list->loadCount('leads', 'suppressedLeads');
        $carrierBreakdown = resolve(CarrierBreakdownService::class)->fromList($list);

        return view('lists.show', compact('list', 'leads', 'carrierBreakdown'));
    }

    public function create()
    {
        return view('lists.create');
    }

    /**
     * @param \App\Http\Requests\ListsControllerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListStoreRequest $request)
    {
        $list = auth()->user()->team->catalogs()->create($request->all());

        return redirect()->route('lists.show', $list);
    }
	
	public function deleteList(Catalog $list)
    {
		//echo"<pre/>";print_r($list);die;
        $list->deleteUserList();
        return back();
    }
}
