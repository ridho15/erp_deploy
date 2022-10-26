<?php

namespace App\CPU;

use App\Models\Barang;
use App\Models\TipeUser;
use App\Models\User;
use App\Models\UserLog;
use App\Models\WebConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    public function getAuthUser($id)
    {
        $user = User::with('tipeUser')->find($id);

        return $user;
    }

    public function splitPhone($phone)
    {
        $phone = preg_replace('~[^0-9]~', '', $phone);
        preg_match('~([0-9]{4})([0-9]{4})([0-9]{3})~', $phone, $matches);

        if (!empty($matches)) {
            $display = $matches[1].' - '.$matches[2].' - '.$matches[3];
        } else {
            $display = 'An invalid phone number was entered.';
        }

        return $display;
    }

    public function getBarang($id)
    {
        $barang = Barang::find($id);

        return $barang;
    }

    public static function gen_mpdf($view, $file_prefix, $file_postfix)
    {
        $mpdf = new \Mpdf\Mpdf(['default_font' => 'FreeSerif', 'mode' => 'utf-8', 'format' => [190, 236]]);
        $mpdf->AddPage('L', '', '', '', '', 0, 0, 0, '', '', '');
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf_view = $view;
        $mpdf_view = $mpdf_view->render();
        $mpdf->WriteHTML($mpdf_view);
        $mpdf->Output($file_prefix.$file_postfix.'.pdf', 'D');
    }

    public static function getSetting($object, $name)
    {
        $config = null;
        foreach ($object as $set) {
            if ($set['type'] == $name) {
                $config = $set['value'];
            }
        }

        return $config;
    }

    public static function config($name)
    {
        $response = '';
        $config = WebConfig::where('type', $name);
        if ($config) {
            $response = $config;

            return $response;
        }

        return $response;
    }

    public static function dateChange($date)
    {
        $day = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];

        $hari = [
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum\'at',
            'Sabtu',
        ];

        $d = str_replace($day, $hari, $date);

        $month = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $x = str_replace($month, $bulan, $d);

        return $x;
    }

    public static function getUserLogs($id)
    {
        $log = UserLog::with('user')->find($id);

        return $log;
    }

    public static function getTipeUser($id)
    {
        $tipe = TipeUser::find($id);

        return $tipe->nama_tipe;
    }

    public static function regexUserAgent($ua)
    {
        $ua = is_null($ua) ? $_SERVER['HTTP_USER_AGENT'] : $ua;
        // Enumerate all common platforms, this is usually placed in braces (order is important! First come first serve..)
        $platforms = 'Windows|iPad|iPhone|Macintosh|Android|BlackBerry';

        // All browsers except MSIE/Trident and..
        // NOT for browsers that use this syntax: Version/0.xx Browsername
        $browsers = 'Firefox|Chrome';

        // Specifically for browsers that use this syntax: Version/0.xx Browername
        $browsers_v = 'Safari|Mobile'; // Mobile is mentioned in Android and BlackBerry UA's

        // Fill in your most common engines..
        $engines = 'Gecko|Trident|Webkit|Presto';

        // Regex the crap out of the user agent, making multiple selections and..
        $regex_pat = "/((Mozilla)\/[\d\.]+|(Opera)\/[\d\.]+)\s\(.*?((MSIE)\s([\d\.]+).*?(Windows)|({$platforms})).*?\s.*?({$engines})[\/\s]+[\d\.]+(\;\srv\:([\d\.]+)|.*?).*?(Version[\/\s]([\d\.]+)(.*?({$browsers_v})|$)|(({$browsers})[\/\s]+([\d\.]+))|$).*/i";

        // .. placing them in this order, delimited by |
        $replace_pat = '$7$8|$2$3|$9|${17}${15}$5$3|${18}${13}$6${11}';

        // Run the preg_replace .. and explode on |
        $ua_array = explode('|', preg_replace($regex_pat, $replace_pat, $ua, PREG_PATTERN_ORDER));

        if (count($ua_array) > 1) {
            $return['platform'] = $ua_array[0];  // Windows / iPad / MacOS / BlackBerry
        $return['type'] = $ua_array[1];  // Mozilla / Opera etc.
        $return['renderer'] = $ua_array[2];  // WebKit / Presto / Trident / Gecko etc.
        $return['browser'] = $ua_array[3];  // Chrome / Safari / MSIE / Firefox

        /*
        Not necessary but this will filter out Chromes ridiculously long version
        numbers 31.0.1234.122 becomes 31.0, while a "normal" 3 digit version number
        like 10.2.1 would stay 10.2.1, 11.0 stays 11.0. Non-match stays what it is.
        */

            if (preg_match("/^[\d]+\.[\d]+(?:\.[\d]{0,2}$)?/", $ua_array[4], $matches)) {
                $return['version'] = $matches[0];
            } else {
                $return['version'] = $ua_array[4];
            }
        } else {
            /*
            Unknown browser..
            This could be a deal breaker for you but I use this to actually keep old
            browsers out of my application, users are told to download a compatible
            browser (99% of modern browsers are compatible. You can also ignore my error
            but then there is no guarantee that the application will work and thus
            no need to report debugging data.
             */

            return false;
        }

        // Replace some browsernames e.g. MSIE -> Internet Explorer
        switch (strtolower($return['browser'])) {
        case 'msie':
        case 'trident':
            $return['browser'] = 'Internet Explorer';
            break;
        case '': // IE 11 is a steamy turd (thanks Microsoft...)
            if (strtolower($return['renderer']) == 'trident') {
                $return['browser'] = 'Internet Explorer';
            }
        break;
    }

        switch (strtolower($return['platform'])) {
        case 'android':    // These browsers claim to be Safari but are BB Mobile
        case 'blackberry': // and Android Mobile
            if ($return['browser'] == 'Safari' || $return['browser'] == 'Mobile' || $return['browser'] == '') {
                $return['browser'] = "{$return['platform']} mobile";
            }
            break;
    }

        return $return;
    }

    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        $old_image = $old_image['value'];
        if (Storage::disk('public')->exists($dir.$old_image)) {
            Storage::disk('public')->delete($dir.$old_image);
        }
        $imageName = Helpers::upload($dir, $format, $image);

        return $imageName;
    }

    public static function upload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.$format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir, $image);
        } else {
            $imageName = 'def.png';
        }

        return $image;
    }
}
