<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $httpClient;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->httpClient = new HttpClient([
            'base_uri' => 'https://us5.api.mailchimp.com',
            'timeout'  => 2.0,
        ]);
    }

    public function add(Request $request)
    {
        $mailchimpApiKey = env('MAILCHIMP_API_KEY');
        $response = $this->httpClient->request('POST', '/3.0/lists/f0062afff6/members/', [
            RequestOptions::HEADERS => [
                'Authorization' => 'apikey ' . $mailchimpApiKey
            ],
            RequestOptions::JSON => $request->input()
        ]);

        return $response;
    }

}
