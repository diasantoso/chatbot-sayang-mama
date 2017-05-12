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
  public function checkJam($jamLama, $menitLama, $jamSekarang, $menitSekarang) {
    $jangkaPengingat = 1; //Type Waktu Jam
    $jamPengingat = $jamLama - $jangkaPengingat;
    if( ($jamSekarang==$jamPengingat) && (($menitLama+5)>$menitSekarang) && ($menitSekarang>=$menitLama) ) {
      return true;
    } else {
      return false;
    }
  }

  public function cobaReminderKuliah() {
    $registerUrl = "qwewe";
    $textReceived = "Ditoparker@gmail.com-1234";
    $email = "ditoparker@gmail.com";
    $password = "1234";
    $userId = "Ud6c98299e8a444e219b9479efe772f52";
    if (($check = strpos($textReceived, "-")) !== FALSE) {
      $email = strtok($textReceived, '-');
      $password = substr($textReceived, strpos($textReceived, "-") +1);

      if($this->checkEmail($email) == true) {
        if($this->checkPassword($userId, $email, $password)== true ) {
          $textSend = "Selamat anda berhasil login, sekarang anda sudah bisa menggunakan fitur kuliah ChatBot";
        } else {
          $textSend = "Maaf email atau password anda salah". PHP_EOL .
          "atau anda belum terdaftar". PHP_EOL .
          "jika anda belum mendaftar, silahkan daftarkan diri anda di : ". PHP_EOL .$registerUrl . PHP_EOL .
          "Jika anda kesulitan, silahkan gunakan perintah 'help' ";
        }
      } else {
        $textSend = "Maaf email atau password anda salah". PHP_EOL .
        "atau anda belum terdaftar". PHP_EOL .
        "jika anda belum mendaftar, silahkan daftarkan diri anda di : ". PHP_EOL .$registerUrl . PHP_EOL .
        "Jika anda kesulitan, silahkan gunakan perintah 'help' ";
      }
    } else {
      $textSend = "Maaf anda perlu login terlebih dahulu".PHP_EOL.
      "silahkan kirimkan chat email dan password yang sudah anda daftarkan di ". PHP_EOL .$registerUrl. PHP_EOL .
      "dengan format : email-password". PHP_EOL .
      "contoh: asdf@gmail.com-1234 " . PHP_EOL .
      "Jika anda kesulitan, silahkan gunakan perintah 'help' ";
    }

    echo $this->checkPassword($userId, $email, $password);
    // init bot
    // $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('CHANNEL_ACCESS_TOKEN'));
    // $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => env('CHANNEL_SECRET')]);
    //
    // $now = Carbon::now();
    //
    // $dateNow = substr($now, 0, 10);
    // $timeNow = substr($now, 11, 18);
    //
    // $dayNow = Carbon::now()->format('l');
    //
    // $semuaUser = User::where('deleted_at', null)->get();
    //
    // $hari = "kosong";
    // $count = 0;
    //
    // foreach ($semuaUser as $user) {
    //   if($user->chat_log_line_id != null) {
    //     $userId = $user->chatLog->chat_id;
    //
    //     foreach ($user->jadwal as $jadwal) {
    //       $hariKuliah = $jadwal->sesiMulai->hari;
    //       $jamKuliah = $jadwal->sesiMulai->waktu;
    //
    //       $jamBaru = substr($jamKuliah,0,2);
    //       $menitBaru = substr($jamKuliah,3,2);
    //
    //       $jamLama = substr($timeNow,0,2);
    //       $menitLama = substr($timeNow,3,2);
    //
    //       if(substr($jamBaru,0,1) == 0) {
    //         $jam = substr($jamBaru,1,1);
    //       } else {
    //         $jam = $jamBaru;
    //       }
    //
    //       if(substr($menitBaru,0,1) == 0) {
    //         $menit = substr($menitBaru,1,1);
    //       } else {
    //         $menit = $menitBaru;
    //       }
    //
    //       if(substr($jamLama,0,1) == 0) {
    //         $jamNow = substr($jamLama,1,1);
    //       } else {
    //         $jamNow = $jamLama;
    //       }
    //
    //       if(substr($menitLama,0,1) == 0) {
    //         $menitNow = substr($menitLama,1,1);
    //       } else {
    //         $menitNow = $menitLama;
    //       }
    //
    //       $jangkaPengingat = 1; //Type Waktu Jam
    //       $jamPengingat = $jam - $jangkaPengingat;
    //
    //       if(strcasecmp($hariKuliah, "Senin")==0 && strcasecmp($dayNow, "Monday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           // $hari = "Senin";
    //           // $count++;
    //         }
    //       } else if(strcasecmp($hariKuliah, "Selasa")==0 && strcasecmp($dayNow, "Tuesday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           // $hari = "Selasa";
    //           // $count++;
    //         }
    //       } else if(strcasecmp($hariKuliah, "Rabu")==0 && strcasecmp($dayNow, "Wednesday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           // $hari = "Rabu";
    //           // $count++;
    //         }
    //       } else if(strcasecmp($hariKuliah, "Kamis")==0 && strcasecmp($dayNow, "Thursday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           $hari = "Kamis";
    //           $count++;
    //         }
    //       } else if(strcasecmp($hariKuliah, "Jumat")==0 && strcasecmp($dayNow, "Friday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           // $hari = "Jumat";
    //           // $count++;
    //         }
    //       } else if(strcasecmp($hariKuliah, "Sabtu")==0 && strcasecmp($dayNow, "Saturday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           // $hari = "Sabtu";
    //           // $count++;
    //         }
    //       } else if(strcasecmp($hariKuliah, "Minggu")==0 && strcasecmp($dayNow, "Sunday")==0 ) {
    //         if( ($jamNow==$jamPengingat) && (($menit+5)>$menitNow) && ($menitNow>=$menit) ) {
    //           $text = "[Kuliah ".$jadwal->makul->nama." 1 jam lagi]" .
    //                   PHP_EOL .
    //                   PHP_EOL .
    //                   "Ruangan : ".$jadwal->ruangan;
    //           $textSend = $text;
    //
    //           $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    //           $result = $bot->pushMessage($userId, $textMessageBuilder);
    //
    //           return $result->getHTTPStatus() . ' ' . $result->getRawBody();
    //           // $hari = "Minggu";
    //           // $count++;
    //         }
    //       }
    //
    //     }
    //   }
    //
    // }
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
          $registerUrl = "http://ditoraharjo.co/chatbot";
          // $registerUrl = "UNDER MAINTENANCE";
          $userId = $event['source']['userId'];
          $replyToken = $event['replyToken'];

          //To save chat log
          $this->getUser($userId);

          $textReceived = $event['message']['text'];
          $helpCommand = "Halo, berikut perintah-perintah yang dapat digunakan di ChatBot : " . PHP_EOL .
          "jadwal kuliah : Untuk menampilkan semua jadwal kuliah" . PHP_EOL .
          "(keyword) : Untuk menampilkan informasi jadwal sesuai dengan keyword yang sudah ditentukan" . PHP_EOL .
          "logout : Untuk keluar dari akun yang sedang anda gunakan pada platform chat". PHP_EOL .
          PHP_EOL . "Jika anda belum pernah melakukan login sebelumnya, maka anda perlu login terlebih dahulu di platform chat dengan mengetikkan email dan password anda dengan format :". PHP_EOL ."email-password". PHP_EOL ."contoh : asd@gmail.com-asdfghj";

          if($this->checkLogin($userId) == true) {
            $checkMakulResult = $this->checkMakul($userId, $textReceived);
            if($checkMakulResult != false) {
              $textSend = $checkMakulResult;
            } else {
              if(strcasecmp($textReceived, "halo")==0) {
                $opts = array(
                  'http'=>array(
                    'method'=>"GET",
                    'header'=>"Authorization: Bearer ".env('CHANNEL_ACCESS_TOKEN')
                  )
                );
                $context = stream_context_create($opts);

                $website = "https://api.line.me/v2/bot/profile/".$userId;
                $user = file_get_contents($website, false, $context);

                $user = json_decode($user, true);
                $userName = $user['displayName'];

                $textSend = "Halo juga, salam kenal ".$userName;
              } else if(strcasecmp($textReceived, "jadwal kuliah")==0) {

                $textSend = $this->getJadwalKuliah($userId);

              } else if(strcasecmp($textReceived, "jadwal tugas")==0 || strcasecmp($textReceived, "jadwal kuis")==0 || strcasecmp($textReceived, "tugas")==0 || strcasecmp($textReceived, "kuis")==0) {

                $textSend = $this->getJadwalTambahan($userId);

              } else if(strcasecmp($textReceived, "help")==0) {
                $textSend = $helpCommand;
              } else if(strcasecmp($textReceived, "logout")==0) {
                $this->chatLogout($userId);
                $textSend = "Logout berhasil";
              } else {
                $textSend = "Maaf perintah tidak ditemukan.";
              }
            }

          } else if(strcasecmp($textReceived, "help")==0) {
            $textSend = $helpCommand;
          } else {
            if (($check = strpos($textReceived, "-")) !== FALSE) {
              $email = strtok($textReceived, '-');
              $password = substr($textReceived, strpos($textReceived, "-") +1);

              if($this->checkEmail($email) == true) {
                if($this->checkPassword($userId, $email, $password)== true ) {
                  $textSend = "Selamat anda berhasil login, sekarang anda sudah bisa menggunakan fitur kuliah ChatBot";
                } else {
                  $textSend = $this->checkPassword($userId, $email, $password);
                  // $textSend = " Pass Maaf email atau password anda salah". PHP_EOL .
                  // "atau anda belum terdaftar". PHP_EOL .
                  // "jika anda belum mendaftar, silahkan daftarkan diri anda di : ". PHP_EOL .$registerUrl . PHP_EOL .
                  // "Jika anda kesulitan, silahkan gunakan perintah 'help' ";
                }
              } else {
                $textSend = "Email Maaf email atau password anda salah". PHP_EOL .
                "atau anda belum terdaftar". PHP_EOL .
                "jika anda belum mendaftar, silahkan daftarkan diri anda di : ". PHP_EOL .$registerUrl . PHP_EOL .
                "Jika anda kesulitan, silahkan gunakan perintah 'help' ";
              }
            } else {
              $textSend = "Maaf anda perlu login terlebih dahulu".PHP_EOL.
              "silahkan kirimkan chat email dan password yang sudah anda daftarkan di ". PHP_EOL .$registerUrl. PHP_EOL .
              "dengan format : email-password". PHP_EOL .
              "contoh: asdf@gmail.com-1234 " . PHP_EOL .
              "Jika anda kesulitan, silahkan gunakan perintah 'help' ";
            }
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

    $textSend = "coba ping asdf cron jobs - ".Carbon::now();

    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($textSend);
    $result = $bot->pushMessage($userId, $textMessageBuilder);

    return $result->getHTTPStatus() . ' ' . $result->getRawBody();
  }

  public function chatLogout($userId) {
    $check = Chat_Log_line::select('id')->where('chat_id', $userId)->first();
    $chatLog = Chat_Log_line::find($check->id);

    $user = $chatLog->user;

    DB::beginTransaction();

    try {
      $chatLog->user_id = 0;
      $chatLog->save();

      $user->chat_log_line_id = NULL;
      $user->save();

      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();

      throw $e;
    }
  }

  public function getUser($userId) {
    $check = Chat_Log_line::select('id')->where('chat_id', $userId)->get();
    $checkCount = $check->count();

    if($checkCount == 0) {
      $opts = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"Authorization: Bearer ".env('CHANNEL_ACCESS_TOKEN')
        )
      );
      $context = stream_context_create($opts);

      $website = "https://api.line.me/v2/bot/profile/".$userId;
      $user = file_get_contents($website, false, $context);

      $user = json_decode($user, true);

      $user_data = array();
      $user_data['chat_id'] = $userId;
      $user_data['display_name'] = $user['displayName'];

      DB::beginTransaction();

      try {
        Chat_Log_line::create($user_data);

        DB::commit();
      } catch (\Exception $e) {
        DB::rollback();

        throw $e;
      }
    }
  }

  public function checkLogin($userId) {
    $check = Chat_Log_line::select('id')->where('chat_id', $userId)->first();
    $checkCount = $check->count();
    if($checkCount == 1) {
      $chatLog = Chat_Log_line::find($check->id);

      if($chatLog->user_id == 0) {
        return false;
      } else {
        return true;
      }
    } else {
      return false;
    }
  }

  public function checkEmail($email) {
    $check = User::select('id')->where('email', 'LIKE', $email)->get();
    $checkCount = $check->count();

    if($checkCount != 0) {
      return true;
    } else {
      return false;
    }
  }

  public function checkPassword($userId, $email, $password) {
    $check = User::select('id')->where([
      ['email', 'LIKE', $email]
      ])->first();
    $checkCount = $check->count();

    if($checkCount != 0) {
      $user_data = User::find($check->id);

      if(Hash::check($password, $user_data->password) ) {
        $checkChatLog = Chat_Log_line::select('id')->where('chat_id', $userId)->first();
        $checkCountChatLog = $checkChatLog->count();

        if($checkCountChatLog == 1) {
          $chat_log_data = Chat_Log_line::find($checkChatLog->id);

          DB::beginTransaction();

          try {
            $user_data->chat_log_line_id = $chat_log_data->id;
            return $chat_log_data->user_id = $user_data->id;

            $user_data->save();
            $chat_log_data->save();

            DB::commit();
          } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return "false0";
          }
          return true;

        } else {
          return "false1";
        }
      } else {
        return "false2";
      }
    } else {
      return "false";
    }
  }

  public function getJadwalKuliah($userId) {
    $check = Chat_Log_line::select('id')->where('chat_id', $userId)->first();
    $chatLog = Chat_Log_line::find($check->id);

    $semuaJadwal = $chatLog->user->jadwal;

    for ($i = 0 ; $i<$semuaJadwal->count(); $i++) {
      for($j = 0 ; $j<$semuaJadwal->count(); $j++) {
        if($semuaJadwal[$i]->sesi_mulai < $semuaJadwal[$j]->sesi_mulai) {
          $temp = $semuaJadwal[$i];
          $semuaJadwal[$i] = $semuaJadwal[$j];
          $semuaJadwal[$j] = $temp;
        }
      }
    }

    if($semuaJadwal->count() > 0) {
      $senin = "";
      $selasa = "";
      $rabu = "";
      $kamis = "";
      $jumat = "";
      $sabtu = "";

      foreach ($semuaJadwal as $jadwal) {
        $makul = $jadwal->makul->nama;
        $kelas = $jadwal->kelas;
        $ruangan = $jadwal->ruangan;
        $sesiMulai = $jadwal->sesiMulai->sesi;
        $sesiSelesai = "";

        $header = "Mata Kuliah : " . $makul ." (". $kelas . ")";
        $middle = "Ruangan : " . $ruangan;
        $bottom = "Sesi : " . $sesiMulai;

        $summary = $header . PHP_EOL . $middle . PHP_EOL . $bottom . PHP_EOL . PHP_EOL;

        if(strcasecmp($jadwal->sesiMulai->hari, "Senin")==0) {
          $senin = $senin . $summary;
        } else if(strcasecmp($jadwal->sesiMulai->hari, "Selasa")==0) {
          $selasa = $selasa . $summary;
        } else if(strcasecmp($jadwal->sesiMulai->hari, "Rabu")==0) {
          $rabu = $rabu . $summary;
        } else if(strcasecmp($jadwal->sesiMulai->hari, "Kamis")==0) {
          $kamis = $kamis . $summary;
        } else if(strcasecmp($jadwal->sesiMulai->hari, "Jumat")==0) {
          $jumat = $jumat . $summary;
        } else if(strcasecmp($jadwal->sesiMulai->hari, "Sabtu")==0) {
          $sabtu = $sabtu . $summary;
        }
      }

      if($senin == "") {
        $senin = "KOSONG" . PHP_EOL . PHP_EOL;
      }
      if($selasa == "") {
        $selasa = "KOSONG" . PHP_EOL . PHP_EOL;
      }
      if($rabu == "") {
        $rabu = "KOSONG" . PHP_EOL . PHP_EOL;
      }
      if($kamis == "") {
        $kamis = "KOSONG" . PHP_EOL . PHP_EOL;
      }
      if($jumat == "") {
        $jumat = "KOSONG" . PHP_EOL . PHP_EOL;
      }
      if($sabtu == "") {
        $sabtu = "KOSONG" . PHP_EOL . PHP_EOL;
      }

      $text = "--===Senin===--" . PHP_EOL . $senin . "--===Selasa===--" . PHP_EOL . $selasa . "--===Rabu===--" . PHP_EOL . $rabu . "--===Kamis===--" . PHP_EOL . $kamis . "--===Jumat===--" . PHP_EOL . $jumat . "--===Sabtu===--" . PHP_EOL . $sabtu;

      return $text;
    } else {
      $text = "Maaf anda belum memasukkan data jadwal kuliah.";
      return $text;
    }
  }

  public function getJadwalTambahan($userId) {
    $check = Chat_Log_line::select('id')->where('chat_id', $userId)->first();
    $chatLog = Chat_Log_line::find($check->id);

    $semuaJadwal = $chatLog->user->jadwalTambahan;

    for ($i = 0 ; $i<$semuaJadwal->count(); $i++) {
      for($j = 0 ; $j<$semuaJadwal->count(); $j++) {
        if($semuaJadwal[$i]->sesi_mulai < $semuaJadwal[$j]->sesi_mulai) {
          $temp = $semuaJadwal[$i];
          $semuaJadwal[$i] = $semuaJadwal[$j];
          $semuaJadwal[$j] = $temp;
        }
      }
    }

    if($semuaJadwal->count() > 0) {
      $kuis = "KOSONG";
      $tugas = "KOSONG";

      $isiKuis = "KOSONG";
      $isiTugas = "KOSONG";

      foreach ($semuaJadwal as $jadwal) {
        if($jadwal->type == "Kuis") {
          $nama = $jadwal->nama;
          $makul = $jadwal->makul->nama;
          $waktuMulai = $jadwal->waktu_mulai;
          $waktuSelesai = $jadwal->waktu_selesai;

          $isiKuis = "[".$nama."]" . PHP_EOL . "Mata Kuliah : ".$makul. PHP_EOL . "Waktu Mulai : ".$waktuMulai. PHP_EOL. "Waktu Selesai : ".$waktuSelesai;

          $isiKuis = $isiKuis . PHP_EOL . PHP_EOL;
        } else if($jadwal->type == "Tugas") {
          $nama = $jadwal->nama;
          $makul = $jadwal->makul->nama;
          $waktuMulai = $jadwal->waktu_mulai;
          $waktuSelesai = $jadwal->waktu_selesai;

          $isiTugas = "[".$nama."]" . PHP_EOL . "Mata Kuliah : ".$makul. PHP_EOL . "Waktu Mulai : ".$waktuMulai. PHP_EOL. "Waktu Selesai : ".$waktuSelesai;

          $isiTugas = $isiTugas . PHP_EOL . PHP_EOL;
        }
      }

      $kuis = $isiKuis;
      $tugas = $isiTugas;

      $text = "--===KUIS===--" . PHP_EOL.PHP_EOL . $kuis . "--===TUGAS===--" . PHP_EOL.PHP_EOL . $tugas;

      return $text;
    } else {
      $text = "Maaf anda belum memasukkan data jadwal tugas/kuliah.";
      return $text;
    }
  }

  public function checkMakul($userId, $textReceived) {
    $check = Chat_Log_line::select('id')->where('chat_id', $userId)->first();
    $chatLog = Chat_Log_line::find($check->id);

    $semuaJadwal = $chatLog->user->jadwal;
    $semuaJadwalTambahan = $chatLog->user->jadwalTambahan;

    $total = "";

    foreach ($semuaJadwal as $jadwal) {
      if(strcasecmp($jadwal->keyword, $textReceived)==0 && $jadwal->sesi_selesai == 0) {
        $makul = $jadwal->makul->nama;
        $kelas = $jadwal->kelas;
        $ruangan = $jadwal->ruangan;
        $sesiMulai = $jadwal->sesiMulai->sesi;

        $header = "Mata Kuliah : " . $makul ." (". $kelas . ")";
        $middle = "Ruangan : " . $ruangan;
        $bottom = "Sesi : " . $sesiMulai;
        $summary = $header . PHP_EOL . $middle . PHP_EOL . $bottom . PHP_EOL . PHP_EOL;

        $hari = $jadwal->sesiMulai->hari;
        $text = "--===".$hari."===--". PHP_EOL . $summary;
        return $text;
      } else if(strcasecmp($jadwal->keyword, $textReceived)==0 && $jadwal->sesi_selesai != 0) {
        $hari = $jadwal->sesiMulai->hari;
        $sesiSelesai = $jadwal->sesiSelesai->sesi;

        $makul = $jadwal->makul->nama;
        $kelas = $jadwal->kelas;
        $ruangan = $jadwal->ruangan;
        $sesiMulai = $jadwal->sesiMulai->sesi;

        $header = "Mata Kuliah : " . $makul ." (". $kelas . ")";
        $middle = "Ruangan : " . $ruangan;
        $bottom = "Sesi : " . $sesiMulai . " - " . $sesiSelesai;
        $summary = $header . PHP_EOL . $middle . PHP_EOL . $bottom . PHP_EOL . PHP_EOL;
        $text = "--===".$hari."===--". PHP_EOL . $summary;
        return $text;
      }
    }

    foreach ($semuaJadwalTambahan as $jadwalTambahan) {
      if(strcasecmp($jadwalTambahan->keyword, $textReceived)==0) {
        $makul = $jadwalTambahan->makul->nama;
        $nama = $jadwalTambahan->nama;
        $jenis = $jadwalTambahan->type;
        $waktuMulai = $jadwalTambahan->waktu_mulai;
        $waktuSelesai = $jadwalTambahan->waktu_selesai;

        $header = "Nama ". $jenis ." : " . $nama;
        $header2 = "Mata Kuliah : " . $makul;
        $middle = "Waktu Mulai : " . $waktuMulai;
        $bottom = "Waktu Selesai : " . $waktuSelesai;
        $summary = $header . PHP_EOL . $header2 . PHP_EOL . $middle . PHP_EOL . $bottom . PHP_EOL . PHP_EOL;

        $text = "--===".$jenis."===--". PHP_EOL . $summary;
        return $text;
      }
    }
    return false;
  }

}
