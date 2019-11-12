<?php

namespace App\Http\Controllers\Setting;
use App\Http\Controllers\Controller;
use App\Model\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Setting\CountryRequest;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $dataTables)
    {    if (request()->wantsJson()) {
            $template = 'settings.countries.actions';
            return $dataTables->eloquent(Country::with(['creator','updator'])->select('countries.*'))
                ->editColumn('action', function ($row) use ($template) {
                    $gateKey = 'setting.country';
                    $routeKey = 'setting.country';
                    return view($template, compact('row', 'gateKey', 'routeKey'));
                })
                ->editColumn('display_name', function ($row) {
                    return $row->display_name ? strip_tags($row->display_name) : '';
                })
                
                ->editColumn('created_by', function ($row) {
                    return $row->created_by ? $row->creator->email : '';
                })
                ->editColumn('updated_by', function ($row) {
                    return $row->updated_by ? ucfirst(strtolower($row->updator->email)) : '';
                })
                ->make(true);
         }
         return view('settings.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create([
            'name'=>request('name'),
            'display_name'=>request('display_name'),
            'created_by'=>auth()->id(),
            'code'=>request('code'),
            'monetary'=>request('monetary'),
            'monetary_short_name'=>request('monetary_short_name'),
            'monetary_sign'=>request('monetary_sign'),
        ]);
        alert()->success('success', 'Country  has  successfully added.')->persistent();
        return redirect()->route('setting.country.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        alert()->warning('warning', 'Sorry please  use the provided view Link.')->persistent();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('settings.countries.edit',['show'=>$country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->updated_by = auth()->id();
        $country->update(request([ 'name', 'display_name', 'code', 'monetary', 'monetary_short_name', 'monetary_sign',]));
        alert()->success('success', 'Country  has  successfully Updated.')->persistent();
        return redirect()->route('setting.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        alert()->success('success', 'Country  has  successfully Deleted.')->persistent();
        return redirect()->route('setting.country.index');
    }
}
