<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReferralRequest;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{
    const PAGINATION = 6;
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('index', Referral::class);

        $search = $request->query('search');
        $referrals = Referral::all();

        if(!empty($search)) {
            $referrals = $referrals->filter(function($record) use ($search){
                if($record->isMatch($search)) return $record;
                return false;
            });
        }


        $count = count($referrals);
        $page = (request('page'))?:1;
        $offset = self::PAGINATION * ($page - 1);
        $paginator = new LengthAwarePaginator($referrals->slice($offset,self::PAGINATION),$count,self::PAGINATION,$page,[
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);
        $referrals = $paginator;


        return view('referrals.index')->with('referrals', $referrals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Referral::class);
        return view('referrals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreReferralRequest $request)
    {
        $this->authorize('create', Referral::class);
        Referral::create($request->all());
        return redirect('referrals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Referral $referral)
    {
        $this->authorize('index', $referral);
        return view('referrals.show')->with('referral', $referral);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        $this->authorize('update', $referral);
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
        $this->authorize('update', $referral);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        $this->authorize('delete', $referral);
    }

    public function upload()
    {
        $this->authorize('bulkCreate', Referral::class);
        return view('referrals.upload');
    }

    public function processUpload(Request $request)
    {
        $this->authorize('bulkCreate', Referral::class);
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
