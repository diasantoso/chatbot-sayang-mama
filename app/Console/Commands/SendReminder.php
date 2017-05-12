<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use \LINE\LINEBot\SignatureValidator as SignatureValidator;

use Carbon\Carbon;

use App\User;
use App\Prodi;
use App\Fakultas;
use App\Jadwal;
use App\Jadwal_Tambahan;
use App\Chat_Log_line;

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

      $now = Carbon::now();

      $dateNow = substr($now, 0, 10);
      $timeNow = substr($now, 11, 18);

      $dayNow = Carbon::now()->format('l');

      $semuaUser = User::where('deleted_at', null)->get();

      $hari = "kosong";
      $count = 0;

      foreach ($semuaUser as $user) {
        if($user->chat_log_line_id != null) {
          $userId = $user->chatLog->chat_id;

          foreach ($user->jadwal as $jadwal) {
            $hariKuliah = $jadwal->sesiMulai->hari;
            $jamKuliah = $jadwal->sesiMulai->waktu;

            $jamBaru = substr($jamKuliah,0,2);
            $menitBaru = substr($jamKuliah,3,2);

            $jamLama = substr($timeNow,0,2);
            $menitLama = substr($timeNow,3,2);

            if(substr($jamBaru,0,1) == 0) {
              $jam = substr($jamBaru,1,1);
            } else {
              $jam = $jamBaru;
            }

            if(substr($menitBaru,0,1) == 0) {
              $menit = substr($menitBaru,1,1);
            } else {
              $menit = $menitBaru;
            }

            if(substr($jamLama,0,1) == 0) {
              $jamNow = substr($jamLama,1,1);
            } else {
              $jamNow = $jamLama;
            }

            if(substr($menitLama,0,1) == 0) {
              $menitNow = substr($menitLama,1,1);
            } else {
              $menitNow = $menitLama;
            }

            $jangkaPengingat = 1; //Type Waktu Jam
            $jamPengingat = $jam - $jangkaPengingat;

            if(strcasecmp($hariKuliah, "Senin")==0 && strcasecmp($dayNow, "Monday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Senin";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Selasa")==0 && strcasecmp($dayNow, "Tuesday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Selasa";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Rabu")==0 && strcasecmp($dayNow, "Wednesday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Rabu";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Kamis")==0 && strcasecmp($dayNow, "Thursday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                // $hari = "Kamis";
                // $count++;
              }
            } else if(strcasecmp($hariKuliah, "Jumat")==0 && strcasecmp($dayNow, "Friday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Jumat";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Sabtu")==0 && strcasecmp($dayNow, "Saturday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Sabtu";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Minggu")==0 && strcasecmp($dayNow, "Sunday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                        PHP_EOL .
                        PHP_EOL .
                        "Ruangan : ".$jadwal->ruangan;
                $textSend = $text;

                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                $result = $bot->pushMessage($userId, $textMessageBuilder);

                return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Minggu";
                $count++;
              }
            }

          }
        }

      }

      $userId = "Ud6c98299e8a444e219b9479efe772f52";
      $text = "Hari : ". $hari . PHP_EOL . "Count : ". $count;
      $textSend = $text;

      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
      $result = $bot->pushMessage($userId, $textMessageBuilder);

      return $result->getHTTPStatus() . ' ' . $result->getRawBody();
      // echo $hari."</br>";
      // echo $count;
      // $this->cobaReminderKuliah();
      //
      // $this->cobaReminderTambahan();
    }

    public function cobaReminderKuliah() {
      // init bot
      $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
      $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

      $now = Carbon::now();

      $dateNow = substr($now, 0, 10);
      $timeNow = substr($now, 11, 18);

      $dayNow = Carbon::now()->format('l');

      $semuaUser = User::where('deleted_at', null)->get();

      $hari = "kosong";
      $count = 0;

      foreach ($semuaUser as $user) {
        if($user->chat_log_line_id != null) {
          $userId = $user->chatLog->chat_id;

          foreach ($user->jadwal as $jadwal) {
            $hariKuliah = $jadwal->sesiMulai->hari;
            $jamKuliah = $jadwal->sesiMulai->waktu;

            $jamBaru = substr($jamKuliah,0,2);
            $menitBaru = substr($jamKuliah,3,2);

            $jamLama = substr($timeNow,0,2);
            $menitLama = substr($timeNow,3,2);

            if(substr($jamBaru,0,1) == 0) {
              $jam = substr($jamBaru,1,1);
            } else {
              $jam = $jamBaru;
            }

            if(substr($menitBaru,0,1) == 0) {
              $menit = substr($menitBaru,1,1);
            } else {
              $menit = $menitBaru;
            }

            if(substr($jamLama,0,1) == 0) {
              $jamNow = substr($jamLama,1,1);
            } else {
              $jamNow = $jamLama;
            }

            if(substr($menitLama,0,1) == 0) {
              $menitNow = substr($menitLama,1,1);
            } else {
              $menitNow = $menitLama;
            }

            $jangkaPengingat = 1; //Type Waktu Jam
            $jamPengingat = $jam - $jangkaPengingat;

            if(strcasecmp($hariKuliah, "Senin")==0 && strcasecmp($dayNow, "Monday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Senin";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Selasa")==0 && strcasecmp($dayNow, "Tuesday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Selasa";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Rabu")==0 && strcasecmp($dayNow, "Wednesday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Rabu";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Kamis")==0 && strcasecmp($dayNow, "Thursday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                // $hari = "Kamis";
                // $count++;
              }
            } else if(strcasecmp($hariKuliah, "Jumat")==0 && strcasecmp($dayNow, "Friday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Jumat";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Sabtu")==0 && strcasecmp($dayNow, "Saturday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                // $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                //         PHP_EOL .
                //         PHP_EOL .
                //         "Ruangan : ".$jadwal->ruangan;
                // $textSend = $text;
                //
                // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                // $result = $bot->pushMessage($userId, $textMessageBuilder);
                //
                // return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Sabtu";
                $count++;
              }
            } else if(strcasecmp($hariKuliah, "Minggu")==0 && strcasecmp($dayNow, "Sunday")==0 ) {
              if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
                $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
                        PHP_EOL .
                        PHP_EOL .
                        "Ruangan : ".$jadwal->ruangan;
                $textSend = $text;

                $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
                $result = $bot->pushMessage($userId, $textMessageBuilder);

                return $result->getHTTPStatus() . ' ' . $result->getRawBody();
                $hari = "Minggu";
                $count++;
              }
            }

          }
        }

      }

      $userId = "Ud6c98299e8a444e219b9479efe772f52";
      $text = "Hari : ". $hari . PHP_EOL . "Count : ". $count;
      $textSend = $text;

      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
      $result = $bot->pushMessage($userId, $textMessageBuilder);

      return $result->getHTTPStatus() . ' ' . $result->getRawBody();
      // echo $hari."</br>";
      // echo $count;
    }

    public function cobaReminderTambahan() {
      // init bot
      $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
      $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);

      $now = Carbon::now();

      $dateNow = substr($now, 0, 10);
      $timeNow = substr($now, 11, 18);

      $yearNow = substr($dateNow, 0, 4);
      $monthNow = substr($dateNow, 5, 2);
      $dayNow = substr($dateNow, 8, 2);
      if(substr($dayNow,0,1) == 0) {
        $dayNow = substr($dayNow,1,1);
      } else {
        $dayNow = $dayNow;
      }
      if(substr($monthNow,0,1) == 0) {
        $monthNow = substr($monthNow,1,1);
      } else {
        $monthNow = $monthNow;
      }

      $jamNow = substr($timeNow,0,2);
      $menitNow = substr($timeNow,3,2);
      if(substr($jamNow,0,1) == 0) {
        $jamNow = substr($jamNow,1,1);
      } else {
        $jamNow = $jamNow;
      }
      if(substr($menitNow,0,1) == 0) {
        $menitNow = substr($menitNow,1,1);
      } else {
        $menitNow = $menitNow;
      }

      $semuaUser = User::where('deleted_at', '=', NULL)->get();

      $countMulai = 0;
      $countSelesai = 0;

      foreach ($semuaUser as $user) {
        if($user->chat_log_line_id != null) {
          $userId = $user->chatLog->chat_id;

          foreach ($user->jadwalTambahan as $jadwal) {
            $waktuMulai = $jadwal->waktu_mulai;
            $waktuSelesai = $jadwal->waktu_selesai;

            $dateMulai = substr($waktuMulai, 0, 10);
            $timeMulai = substr($waktuMulai, 11, 18);

            $dateSelesai = substr($waktuSelesai, 0, 10);
            $timeSelesai = substr($waktuSelesai, 11, 18);

            $yearMulai = substr($dateMulai, 0, 4);
            $monthMulai = substr($dateMulai, 5, 2);
            $dayMulai = substr($dateMulai, 8, 2);
            if(substr($dayMulai,0,1) == 0) {
              $dayMulai = substr($dayMulai,1,1);
            } else {
              $dayMulai = $dayMulai;
            }
            if(substr($monthMulai,0,1) == 0) {
              $monthMulai = substr($monthMulai,1,1);
            } else {
              $monthMulai = $monthMulai;
            }

            $yearSelesai = substr($dateSelesai, 0, 4);
            $monthSelesai = substr($dateSelesai, 5, 2);
            $daySelesai = substr($dateSelesai, 8, 2);
            if(substr($daySelesai,0,1) == 0) {
              $daySelesai = substr($daySelesai,1,1);
            } else {
              $daySelesai = $daySelesai;
            }
            if(substr($monthSelesai,0,1) == 0) {
              $monthSelesai = substr($monthSelesai,1,1);
            } else {
              $monthSelesai = $monthSelesai;
            }

            $jamMulai = substr($timeMulai,0,2);
            $menitMulai = substr($timeMulai,3,2);
            if(substr($jamMulai,0,1) == 0) {
              $jamMulai = substr($jamMulai,1,1);
            } else {
              $jamMulai = $jamMulai;
            }
            if(substr($menitMulai,0,1) == 0) {
              $menitMulai = substr($menitMulai,1,1);
            } else {
              $menitMulai = $menitMulai;
            }

            $jamSelesai = substr($timeSelesai,0,2);
            $menitSelesai = substr($timeSelesai,3,2);
            if(substr($jamSelesai,0,1) == 0) {
              $jamSelesai = substr($jamSelesai,1,1);
            } else {
              $jamSelesai = $jamSelesai;
            }
            if(substr($menitSelesai,0,1) == 0) {
              $menitSelesai = substr($menitSelesai,1,1);
            } else {
              $menitSelesai = $menitSelesai;
            }

            if($yearNow==$yearMulai && $monthNow==$monthMulai && $dayNow==$dayMulai && $jamNow==$jamMulai && (($menitMulai+5)>$menitNow) && ($menitNow>=$menitMulai) ) {
              $text = "[".$jadwal->type." ".$jadwal->nama." Telah Dibuka]" .
                      PHP_EOL .
                      PHP_EOL .
                      "Mata Kuliah : ".$jadwal->makul->nama.
                      "Deadline : ".$jadwal->waktu_selesai;
              $textSend = $text;

              $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
              $result = $bot->pushMessage($userId, $textMessageBuilder);

              return $result->getHTTPStatus() . ' ' . $result->getRawBody();

              // $countMulai++;
            }

            $jangkaPengingat = 1;
            $jangkaReminder = $jamSelesai - $jangkaPengingat;

            if($yearNow==$yearSelesai && $monthNow==$monthSelesai && $dayNow==$daySelesai && $jamNow==$jangkaReminder && (($menitSelesai+5)>$menitNow) && ($menitNow>=$menitSelesai) ) {
              $text = "[".$jadwal->type." ".$jadwal->nama." Akan Ditutup 1 Jam Lagi]" .
                      PHP_EOL .
                      PHP_EOL .
                      "Mata Kuliah : ".$jadwal->makul->nama.
                      "Deadline : ".$jadwal->waktu_selesai;
              $textSend = $text;

              $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
              $result = $bot->pushMessage($userId, $textMessageBuilder);

              return $result->getHTTPStatus() . ' ' . $result->getRawBody();
              // $countSelesai++;
            }

          }
        }

      }

      // echo $countMulai."</br>";
      // echo $countSelesai;
    }
}
