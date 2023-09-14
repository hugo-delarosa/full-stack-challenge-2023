<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReferralRequest;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($country=null, $city=null)
    {

        $countries = array();
        $cities = array();
        $country_filter = false;
        //
        if($country == null) { 
            $referrals = Referral::paginate(15);
            $countries = Referral::getCountries();
        }
        elseif($city == null) {
            $country_filter = true;
            $referrals = Referral::where("country", $country)->paginate(15);
            $countries = array($country);
            $cities = Referral::getCities($country);
        }
        else {
            $country_filter = true;
            $referrals = Referral::where("country", $country)->where("city", $city)->paginate(15);
            $countries = array($country);
            $cities = array($city);
        }
        
        return view('referrals.index', compact('referrals', 'countries', 'cities'))->with('country_filter', $country_filter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('referrals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReferralRequest $request)
    {
        Referral::create($request->all());
        return redirect('referrals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }

    public function upload() {
        return view('referrals.upload');
    }

    public function processUpload(Request $request) {
        $columns =  new Referral;
        $succeed = 0;
        $failed = $record = [];

        if ($request->file('referral_file')->isValid()) {
            if($request->referral_file->extension() == "txt") {

                $file = fopen($request->referral_file->path(), "r");
                while (($data = fgetcsv($file, 200, ",")) !==FALSE ) {
                    if(count($columns->getFillable()) == count($data)) {
                        $record = array_combine($columns->getFillable(), $data);
                        Referral::create($record);
                        $succeed++;
                    }
                    else {
                        $failed[] = $data[0];
                        Log::critical("Failed - data c = " . count($data).  " field c = " . count($columns->getFillable()) . " => ".implode(',', $data));
                    }
                }

                if(count($failed)>0) {
                    $request->session()->flash('error', "Reference Nos. " . implode(',', $failed) . ' failed to upload!');
                } else {
                    $request->session()->flash('status', $succeed . ' records uploaded successful!');
                }
            }
        }

        return redirect('referrals');
    }
}
