<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use \LINE\LINEBot\SignatureValidator as SignatureValidator;

use Carbon\Carbon;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'line:sendReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for sending reminder to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      // init bot
      $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
      $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

      $userId = "Ud6c98299e8a444e219b9479efe772f52";

      $textSend = "coba cron jobs - ".Carbon::now();

      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
      $result = $bot->pushMessage($userId, $textMessageBuilder);

      return $result->getHTTPStatus() . ' ' . $result->getRawBody();

      $this->info('The messages were sent successfully ululululu!');
    }
}
