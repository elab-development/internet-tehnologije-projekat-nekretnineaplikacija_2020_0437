<?php

namespace App\Http\Controllers;

use App\Models\InstagramAccount;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class InstagramAccountController extends Controller
{
    private $client;
    private $accessToken;

    public function __construct()
    {
        $this->client = new Client();
         
        $this->accessToken = env('INSTAGRAM_ACCESS_TOKEN');
    }

    // Preuzmimanje podataka sa Instagrama
    public function fetchInstagramData($username)
    {
        try {
            $searchUrl = "https://graph.instagram.com/v10.0/search?q={$username}&type=user&access_token={$this->accessToken}";
            $searchResponse = $this->client->request('GET', $searchUrl);
            $searchData = json_decode($searchResponse->getBody()->getContents());
            $userId = $searchData->data->user_id;

            $userDataUrl = "https://graph.instagram.com/{$userId}?fields=id,username,media_count,account_type&access_token={$this->accessToken}";
            $userResponse = $this->client->request('GET', $userDataUrl);
            $userData = json_decode($userResponse->getBody()->getContents());

            $mediaDataUrl = "https://graph.instagram.com/{$userId}/media?fields=id,caption,media_url,media_type,permalink&access_token={$this->accessToken}";
            $mediaResponse = $this->client->request('GET', $mediaDataUrl);
            $mediaData = json_decode($mediaResponse->getBody()->getContents());

            $instagramAccount = InstagramAccount::updateOrCreate(
                ['username' => $userData->username],
                [
                    'media_count' => $userData->media_count,
                    'account_type' => $userData->account_type,
                    'media_data' => $mediaData->data,
                ]
            );

            return response()->json(['account_data' => $userData, 'media_data' => $mediaData]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
