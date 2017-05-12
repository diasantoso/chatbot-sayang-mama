<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Hash;
use DB;

use App\User;
use App\Prodi;
use App\Fakultas;
use App\Jadwal;
use App\Jadwal_Tambahan;
use App\Chat_Log_line;

use \LINE\LINEBot\SignatureValidator as SignatureValidator;

class BotController extends Controller
{
  public function updates(Request $request) {
    // get request body and line signature header
    $body 	   = file_get_contents('php://input');
    $signature = $_SERVER['HTTP_X_LINE_SIGNATURE'];

    // log body and signature
    file_put_contents('php://stderr', 'Body: '.$body);

    // is LINE_SIGNATURE exists in request header?
    if (empty($signature)){
      return $response->withStatus(400, 'Signature not set');
    }

    // is this request comes from LINE?
    if(env('PASS_SIGNATURE') == false && ! SignatureValidator::validateSignature($body, env('CHANNEL_SECRET'), $signature)){
      return $response->withStatus(400, 'Invalid signature');
    }

    // init bot
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

    $data = json_decode($body, true);

    foreach ($data['events'] as $event)
    {
      if ($event['type'] == 'message')
      {
        if($event['message']['type'] == 'text')
        {
          $registerUrl = "COMING SOON";
          // $registerUrl = "UNDER MAINTENANCE";
          $userId = $event['source']['userId'];
          $replyToken = $event['replyToken'];

          $textReceived = $event['message']['text'];

          if(strcasecmp($textReceived, "halo")==0) {
            $textSend = $userId;
          }

          $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
          $result = $bot->pushMessage($userId, $textMessageBuilder);

          return $result->getHTTPStatus() . ' ' . $result->getRawBody();
        }
      }
    }
  }

  public function test() {
    // init bot
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

    $userId = "Ud6c98299e8a444e219b9479efe772f52";

    $textSend = "coba ping cron jobs - ".Carbon::now();

    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    $result = $bot->pushMessage($userId, $textMessageBuilder);

    return $result->getHTTPStatus() . ' ' . $result->getRawBody();
  }
}
