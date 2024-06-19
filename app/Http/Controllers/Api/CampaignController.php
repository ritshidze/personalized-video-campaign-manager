<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\StoreCampaignDataRequest;
use App\Models\Campaign;
use App\Jobs\CampaignUserDataJob;

class CampaignController extends Controller
{

    /**
     * Store a newly created resource.
     */
    public function store(StoreCampaignRequest $request)
    {

        $campaign = Campaign::create($request->all());

        return response()->json($campaign, 201);
    }


    /**
     * Store a newly created resource.
     */
    public function campaignUserData(StoreCampaignDataRequest $request,$campaignId)
    {
     
        $data = $request->all();

        CampaignUserDataJob::dispatch($campaignId, $data);

        return response()->json(['message' => 'Campaign user data added successfully'], 202);
    }

}