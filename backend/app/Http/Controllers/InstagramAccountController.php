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

    // Preuzmite javne podatke za dati Instagram nalog
    public function fetchInstagramData($username)
    {
        try {
            // Preuzmite user_id baziran na username-u koristeći Instagram Graph API
            $searchUrl = "https://graph.instagram.com/v10.0/search?q={$username}&type=user&access_token={$this->accessToken}";
            $searchResponse = $this->client->request('GET', $searchUrl);
            $searchData = json_decode($searchResponse->getBody()->getContents());
            $userId = $searchData->data->user_id;

            // Preuzmite podatke o nalogu koristeći user_id
            $userDataUrl = "https://graph.instagram.com/{$userId}?fields=id,username,media_count,account_type&access_token={$this->accessToken}";
            $userResponse = $this->client->request('GET', $userDataUrl);
            $userData = json_decode($userResponse->getBody()->getContents());

            // Preuzmite medije (slike) naloga
            $mediaDataUrl = "https://graph.instagram.com/{$userId}/media?fields=id,caption,media_url,media_type,permalink&access_token={$this->accessToken}";
            $mediaResponse = $this->client->request('GET', $mediaDataUrl);
            $mediaData = json_decode($mediaResponse->getBody()->getContents());

            // Čuvanje podataka u bazi podataka
            $instagramAccount = InstagramAccount::updateOrCreate(
                ['username' => $userData->username],
                [
                    // Dodajte ostale podatke koje želite da sačuvate
                    'media_count' => $userData->media_count,
                    'account_type' => $userData->account_type,
                    'media_data' => $mediaData->data, // Ovo bi moglo da bude JSON sa svim slikama i informacijama
                ]
            );

            return response()->json(['account_data' => $userData, 'media_data' => $mediaData]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
