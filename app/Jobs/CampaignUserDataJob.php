<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CampaignData;

class CampaignUserDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $campaignId;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($campaignId,$data)
    {
        $this->campaignId = $campaignId;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        foreach ($this->data['data'] as $data) {

            $campaignUserData = new CampaignData();
            $campaignUserData->campaign_id = $this->campaignId;
            $campaignUserData->user_id = $data['user_id'];
            $campaignUserData->video_url = $data['video_url'];
            if(isset($data['custom_fields']))
            {
                $campaignUserData->custom_fields = $data['custom_fields'];
            }
            $campaignUserData->save();
        }
    }
}
