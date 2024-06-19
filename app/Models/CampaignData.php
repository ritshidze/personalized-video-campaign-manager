<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignData extends Model
{
    use HasFactory;

    /**
     * Define the Table Name
     *
     * @var string Table Name
     */
    protected $table = 'campaign_data';

    protected $casts = [
        'custom_fields' => 'json',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'campaign_id',
        'user_id',
        'video_url',
        'custom_fields'
    ];
}