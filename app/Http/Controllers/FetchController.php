<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
class FetchController extends Controller
{
    public function getActorIds($month, $day)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'imdb8.p.rapidapi.com',
            'X-RapidAPI-Key' => '4fd79c35bemshce993313331696dp14bb48jsn41dd8338483e'
        ])->get("https://imdb8.p.rapidapi.com/actors/list-born-today?month={$month}&day={$day}");

        return $response->json();
    }

    public function getActorInfo($id)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'imdb8.p.rapidapi.com',
            'X-RapidAPI-Key' => '4fd79c35bemshce993313331696dp14bb48jsn41dd8338483e'
        ])->get("https://imdb8.p.rapidapi.com/actors/v2/get-bio?nconst={$id}");

        $actor = $response->json()['data']['name']['nameText']['text'];

        return $actor;
    }
    function fetchActors($month,$day){
       ;
        $list = $this->getActorIds($month,$day);

        $count = 0;
        $actors = [];

        foreach ($list as $element) {
            $id = substr($element, 6, -1);
            $actors[] = $this->getActorInfo($id);

            $count += 1;
            if ($count == 6) {
                break;
            }
        }
        $actorString = implode(', ', $actors);
        return $actorString;
    }
    public function sendEmail($message){
        $toEmail="narutoomar12@gmail.com";
        $subject= "New User";
        Mail::to($toEmail)->send(new WelcomeEmail($message,$subject));
        
    }
}
                                   