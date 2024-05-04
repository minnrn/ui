<?php
// Token bot Telegram Anda
$botToken = '7114606161:AAEbMUehRMAudpDIQYiPasmQ6WG3K2RmM7c';
// ID obrolan Anda
$chatID = '7038446148';

// Fungsi untuk mendapatkan alamat IP pengunjung
function getIPAddress() {
    // Periksa apakah alamat IP terletak di belakang proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Mendapatkan alamat IP pengunjung
$visitorIP = getIPAddress();

// Mendapatkan waktu kunjungan dalam zona waktu WITA
date_default_timezone_set('Asia/Makassar');
$visitTime = date('Y-m-d H:i:s');

// Mendapatkan informasi negara berdasarkan alamat IP
$countryInfo = file_get_contents("https://ipinfo.io/$visitorIP/json");

// Mendapatkan kode negara dari respons JSON
$countryJSON = json_decode($countryInfo, true);
$countryCode = $countryJSON['country'];

// Array yang memetakan kode negara ke emoji bendera
$countryFlags = array(
    "AF" => "🇦🇫", "AX" => "🇦🇽", "AL" => "🇦🇱", "DZ" => "🇩🇿", "AS" => "🇦🇸",
    "AD" => "🇦🇩", "AO" => "🇦🇴", "AI" => "🇦🇮", "AQ" => "🇦🇶", "AG" => "🇦🇬",
    "AR" => "🇦🇷", "AM" => "🇦🇲", "AW" => "🇦🇼", "AU" => "🇦🇺", "AT" => "🇦🇹",
    "AZ" => "🇦🇿", "BS" => "🇧🇸", "BH" => "🇧🇭", "BD" => "🇧🇩", "BB" => "🇧🇧",
    "BY" => "🇧🇾", "BE" => "🇧🇪", "BZ" => "🇧🇿", "BJ" => "🇧🇯", "BM" => "🇧🇲",
    "BT" => "🇧🇹", "BO" => "🇧🇴", "BQ" => "🇧🇶", "BA" => "🇧🇦", "BW" => "🇧🇼",
    "BV" => "🇧🇻", "BR" => "🇧🇷", "IO" => "🇮🇴", "BN" => "🇧🇳", "BG" => "🇧🇬",
    "BF" => "🇧🇫", "BI" => "🇧🇮", "CV" => "🇨🇻", "KH" => "🇰🇭", "CM" => "🇨🇲",
    "CA" => "🇨🇦", "KY" => "🇰🇾", "CF" => "🇨🇫", "TD" => "🇹🇩", "CL" => "🇨🇱",
    "CN" => "🇨🇳", "CX" => "🇨🇽", "CC" => "🇨🇨", "CO" => "🇨🇴", "KM" => "🇰🇲",
    "CG" => "🇨🇬", "CD" => "🇨🇩", "CK" => "🇨🇰", "CR" => "🇨🇷", "CI" => "🇨🇮",
    "HR" => "🇭🇷", "CU" => "🇨🇺", "CW" => "🇨🇼", "CY" => "🇨🇾", "CZ" => "🇨🇿",
    "DK" => "🇩🇰", "DJ" => "🇩🇯", "DM" => "🇩🇲", "DO" => "🇩🇴", "EC" => "🇪🇨",
    "EG" => "🇪🇬", "SV" => "🇸🇻", "GQ" => "🇬🇶", "ER" => "🇪🇷", "EE" => "🇪🇪",
    "ET" => "🇪🇹", "FK" => "🇫🇰", "FO" => "🇫🇴", "FJ" => "🇫🇯", "FI" => "🇫🇮",
    "FR" => "🇫🇷", "GF" => "🇬🇫", "PF" => "🇵🇫", "TF" => "🇹🇫", "GA" => "🇬🇦",
    "GM" => "🇬🇲", "GE" => "🇬🇪", "DE" => "🇩🇪", "GH" => "🇬🇭", "GI" => "🇬🇮",
    "GR" => "🇬🇷", "GL" => "🇬🇱", "GD" => "🇬🇩", "GP" => "🇬🇵", "GU" => "🇬🇺",
    "GT" => "🇬🇹", "GG" => "🇬🇬", "GN" => "🇬🇳", "GW" => "🇬🇼", "GY" => "🇬🇾",
    "HT" => "🇭🇹", "HM" => "🇭🇲", "VA" => "🇻🇦", "HN" => "🇭🇳", "HK" => "🇭🇰",
    "HU" => "🇭🇺", "IS" => "🇮🇸", "IN" => "🇮🇳", "ID" => "🇮🇩", "IR" => "🇮🇷",
    "IQ" => "🇮🇶", "IE" => "🇮🇪", "IM" => "🇮🇲", "IL" => "🇮🇱", "IT" => "🇮🇹",
    "JM" => "🇯🇲", "JP" => "🇯🇵", "JE" => "🇯🇪", "JO" => "🇯🇴", "KZ" => "🇰🇿",
    "KE" => "🇰🇪", "KI" => "🇰🇮", "KP" => "🇰🇵", "KR" => "🇰🇷", "KW" => "🇰🇼",
    "KG" => "🇰🇬", "LA" => "🇱🇦", "LV" => "🇱🇻", "LB" => "🇱🇧", "LS" => "🇱🇸",
    "LR" => "🇱🇷", "LY" => "🇱🇾", "LI" => "🇱🇮", "LT" => "🇱🇹", "LU" => "🇱🇺",
    "MO" => "🇲🇴", "MK" => "🇲🇰", "MG" => "🇲🇬", "MW" => "🇲🇼", "MY" => "🇲🇾",
    "MV" => "🇲🇻", "ML" => "🇲🇱", "MT" => "🇲🇹", "MH" => "🇲🇭", "MQ" => "🇲🇶",
    "MR" => "🇲🇷", "MU" => "🇲🇺", "YT" => "🇾🇹", "MX" => "🇲🇽", "FM" => "🇫🇲",
    "MD" => "🇲🇩", "MC" => "🇲🇨", "MN" => "🇲🇳", "ME" => "🇲🇪", "MS" => "🇲🇸",
    "MA" => "🇲🇦", "MZ" => "🇲🇿", "MM" => "🇲🇲", "NA" => "🇳🇦", "NR" => "🇳🇷",
    "NP" => "🇳🇵", "NL" => "🇳🇱", "NC" => "🇳🇨", "NZ" => "🇳🇿", "NI" => "🇳🇮",
    "NE" => "🇳🇪", "NG" => "🇳🇬", "NU" => "🇳🇺", "NF" => "🇳🇫", "MP" => "🇲🇵",
    "NO" => "🇳🇴", "OM" => "🇴🇲", "PK" => "🇵🇰", "PW" => "🇵🇼", "PS" => "🇵🇸",
    "PA" => "🇵🇦", "PG" => "🇵🇬", "PY" => "🇵🇾", "PE" => "🇵🇪", "PH" => "🇵🇭",
    "PN" => "🇵🇳", "PL" => "🇵🇱", "PT" => "🇵🇹", "PR" => "🇵🇷", "QA" => "🇶🇦",
    "RE" => "🇷🇪", "RO" => "🇷🇴", "RU" => "🇷🇺", "RW" => "🇷🇼", "BL" => "🇧🇱",
    "SH" => "🇸🇭", "KN" => "🇰🇳", "LC" => "🇱🇨", "MF" => "🇲🇫", "PM" => "🇵🇲",
    "VC" => "🇻🇨", "WS" => "🇼🇸", "SM" => "🇸🇲", "ST" => "🇸🇹", "SA" => "🇸🇦",
    "SN" => "🇸🇳", "RS" => "🇷🇸", "SC" => "🇸🇨", "SL" => "🇸🇱", "SG" => "🇸🇬",
    "SX" => "🇸🇽", "SK" => "🇸🇰", "SI" => "🇸🇮", "SB" => "🇸🇧", "SO" => "🇸🇴",
    "ZA" => "🇿🇦", "GS" => "🇬🇸", "SS" => "🇸🇸", "ES" => "🇪🇸", "LK" => "🇱🇰",
    "SD" => "🇸🇩", "SR" => "🇸🇷", "SJ" => "🇸🇯", "SZ" => "🇸🇿", "SE" => "🇸🇪",
    "CH" => "🇨🇭", "SY" => "🇸🇾", "TW" => "🇹🇼", "TJ" => "🇹🇯", "TZ" => "🇹🇿",
    "TH" => "🇹🇭", "TL" => "🇹🇱", "TG" => "🇹🇬", "TK" => "🇹🇰", "TO" => "🇹🇴",
    "TT" => "🇹🇹", "TN" => "🇹🇳", "TR" => "🇹🇷", "TM" => "🇹🇲", "TC" => "🇹🇨",
    "TV" => "🇹🇻", "UG" => "🇺🇬", "UA" => "🇺🇦", "AE" => "🇦🇪", "GB" => "🇬🇧",
    "US" => "🇺🇸", "UM" => "🇺🇲", "UY" => "🇺🇾", "UZ" => "🇺🇿", "VU" => "🇻🇺",
    "VE" => "🇻🇪", "VN" => "🇻🇳", "VG" => "🇻🇬", "VI" => "🇻🇮", "WF" => "🇼🇫",
    "EH" => "🇪🇭", "YE" => "🇾🇪", "ZM" => "🇿🇲", "ZW" => "🇿🇼",
);

// Mendapatkan emoji bendera berdasarkan kode negara
$flagEmoji = isset($countryFlags[$countryCode]) ? $countryFlags[$countryCode] : "";

// Pesan yang akan dikirim
$message = "IP: $visitorIP\nWaktu Kunjungan (WITA): $visitTime\nNegara: $flagEmoji";


// URL endpoint untuk mengirim pesan ke bot API Telegram
$url = "https://api.telegram.org/bot$botToken/sendMessage";

// Data yang akan dikirim dalam permintaan POST
$data = array(
    'chat_id' => $chatID,
    'text' => $message
);

// Menginisialisasi cURL untuk melakukan permintaan POST
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi permintaan dan simpan respons
$response = curl_exec($ch);

// Menutup koneksi cURL
curl_close($ch);

// Menampilkan pesan respons dari bot API Telegram
echo $response;
?>