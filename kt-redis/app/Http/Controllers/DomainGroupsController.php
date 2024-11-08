<?php

namespace App\Http\Controllers;

use App\Domain;
use App\DomainGroup;
use App\Jobs\ImportDomain;
use Illuminate\Http\Request;
use App\Jobs\UpdateDomainDNS;
use League\Csv\Reader;

class DomainGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('domain_groups.index', [
            'domainGroups' => team()->domainGroups()->withCount('domains')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain_groups.create', [
            'domainGroup' => new DomainGroup,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'domain_provider_id' => 'required',
        ]);

        team()->domainGroups()->create($data);

        return redirect()->route('domain-groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DomainGroup $domainGroup)
    {

        $domainGroup->loadCount('domains');
        $domains = $domainGroup->domains()->withCount('outbounds')->paginate(50);

        return view('domain_groups.show', compact('domainGroup', 'domains'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainGroup $domainGroup)
    {
        return view('domain_groups.create', [
            'domainGroup' => $domainGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DomainGroup $domainGroup)
    {
        $data = request()->validate([
            'name' => 'required',
            'domain_provider_id' => 'required',
        ]);

        $domainGroup->update($data);

        return redirect()->route('domain-groups.index');
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

    public function storeDomains(DomainGroup $domainGroup)
    {
        request()->validate([
            'file' => ['required'],
        ]);

        $data = request()->file('file')->get();

        $csv = Reader::createFromString($data);

        foreach ($csv->getRecords() as $record) {
            //echo"<pre/>";print_r($record);
            $domain = Domain::create([
                'domain' => $record[0],
                'status' => 'resolving',
                'points_to' => null,
                'dns_last_updated_at' => null,
                'expires_at' => null,
                'domain_group_id' => $domainGroup->id,
                'domain_provider_id' => $domainGroup->domain_provider_id,
                'team_id' => $domainGroup->team_id,
            ]);

            UpdateDomainDNS::dispatch($domain);
        }

        //ImportDomain::dispatch($domainGroup, $data, true);

       return redirect()->route('domain-groups.show', $domainGroup);
    }
}
