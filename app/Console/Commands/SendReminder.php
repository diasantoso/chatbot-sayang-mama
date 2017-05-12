<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use \LINE\LINEBot\SignatureValidator as SignatureValidator;

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

      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
      $result = $bot->pushMessage($userId, $textMessageBuilder);

      return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    }
}
