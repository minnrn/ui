// Token bot Telegram Anda
const botToken = '7114606161:AAEbMUehRMAudpDIQYiPasmQ6WG3K2RmM7c';
// ID obrolan Anda
const chatID = '7038446148';

// Fungsi untuk mendapatkan alamat IP pengunjung
function getIPAddress() {
  // Periksa apakah alamat IP terletak di belakang proxy
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    return $_SERVER['HTTP_CLIENT_IP'];
  } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    return $_SERVER['REMOTE_ADDR'];
  }
}

// Mendapatkan alamat IP pengunjung
const visitorIP = getIPAddress();

// Mendapatkan waktu kunjungan dalam zona waktu WITA
const visitTime = new Date().toLocaleString('en-US', { timeZone: 'Asia/Makassar' });

// Mendapatkan informasi negara berdasarkan alamat IP
fetch(`https://ipinfo.io/${visitorIP}/json`)
  .then(response => response.json())
  .then(data => {
    // Mendapatkan kode negara dari respons JSON
    const countryCode = data.country;

    // Array yang memetakan kode negara ke emoji bendera
    const countryFlags = {
    "AF": "🇦🇫", "AX": "🇦🇽", "AL": "🇦🇱", "DZ": "🇩🇿", "AS": "🇦🇸",
    "AD": "🇦🇩", "AO": "🇦🇴", "AI": "🇦🇮", "AQ": "🇦🇶", "AG": "🇦🇬",
    "AR": "🇦🇷", "AM": "🇦🇲", "AW": "🇦🇼", "AU": "🇦🇺", "AT": "🇦🇹",
    "AZ": "🇦🇿", "BS": "🇧🇸", "BH": "🇧🇭", "BD": "🇧🇩", "BB": "🇧🇧",
    "BY": "🇧🇾", "BE": "🇧🇪", "BZ": "🇧🇿", "BJ": "🇧🇯", "BM": "🇧🇲",
    "BT": "🇧🇹", "BO": "🇧🇴", "BQ": "🇧🇶", "BA": "🇧🇦", "BW": "🇧🇼",
    "BV": "🇧🇻", "BR": "🇧🇷", "IO": "🇮🇴", "BN": "🇧🇳", "BG": "🇧🇬",
    "BF": "🇧🇫", "BI": "🇧🇮", "CV": "🇨🇻", "KH": "🇰🇭", "CM": "🇨🇲",
    "CA": "🇨🇦", "KY": "🇰🇾", "CF": "🇨🇫", "TD": "🇹🇩", "CL": "🇨🇱",
    "CN": "🇨🇳", "CX": "🇨🇽", "CC": "🇨🇨", "CO": "🇨🇴", "KM": "🇰🇲",
    "CG": "🇨🇬", "CD": "🇨🇩", "CK": "🇨🇰", "CR": "🇨🇷", "CI": "🇨🇮",
    "HR": "🇭🇷", "CU": "🇨🇺", "CW": "🇨🇼", "CY": "🇨🇾", "CZ": "🇨🇿",
    "DK": "🇩🇰", "DJ": "🇩🇯", "DM": "🇩🇲", "DO": "🇩🇴", "EC": "🇪🇨",
    "EG": "🇪🇬", "SV": "🇸🇻", "GQ": "🇬🇶", "ER": "🇪🇷", "EE": "🇪🇪",
    "ET": "🇪🇹", "FK": "🇫🇰", "FO": "🇫🇴", "FJ": "🇫🇯", "FI": "🇫🇮",
    "FR": "🇫🇷", "GF": "🇬🇫", "PF": "🇵🇫", "TF": "🇹🇫", "GA": "🇬🇦",
    "GM": "🇬🇲", "GE": "🇬🇪", "DE": "🇩🇪", "GH": "🇬🇭", "GI": "🇬🇮",
    "GR": "🇬🇷", "GL": "🇬🇱", "GD": "🇬🇩", "GP": "🇬🇵", "GU": "🇬🇺",
    "GT": "🇬🇹", "GG": "🇬🇬", "GN": "🇬🇳", "GW": "🇬🇼", "GY": "🇬🇾",
    "HT": "🇭🇹", "HM": "🇭🇲", "VA": "🇻🇦", "HN": "🇭🇳", "HK": "🇭🇰",
    "HU": "🇭🇺", "IS": "🇮🇸", "IN": "🇮🇳", "ID": "🇮🇩", "IR": "🇮🇷",
    "IQ": "🇮🇶", "IE": "🇮🇪", "IM": "🇮🇲", "IL": "🇮🇱", "IT": "🇮🇹",
    "JM": "🇯🇲", "JP": "🇯🇵", "JE": "🇯🇪", "JO": "🇯🇴", "KZ": "🇰🇿",
    "KE": "🇰🇪", "KI": "🇰🇮", "KP": "🇰🇵", "KR": "🇰🇷", "KW": "🇰🇼",
    "KG": "🇰🇬", "LA": "🇱🇦", "LV": "🇱🇻", "LB": "🇱🇧", "LS": "🇱🇸",
    "LR": "🇱🇷", "LY": "🇱🇾", "LI": "🇱🇮", "LT": "🇱🇹", "LU": "🇱🇺",
    "MO": "🇲🇴", "MK": "🇲🇰", "MG": "🇲🇬", "MW": "🇲🇼", "MY": "🇲🇾",
    "MV": "🇲🇻", "ML": "🇲🇱", "MT": "🇲🇹", "MH": "🇲🇭", "MQ": "🇲🇶",
    "MR": "🇲🇷", "MU": "🇲🇺", "YT": "🇾🇹", "MX": "🇲🇽", "FM": "🇫🇲",
    "MD": "🇲🇩", "MC": "🇲🇨", "MN": "🇲🇳", "ME": "🇲🇪", "MS": "🇲🇸",
    "MA": "🇲🇦", "MZ": "🇲🇿", "MM": "🇲🇲", "NA": "🇳🇦", "NR": "🇳🇷",
    "NP": "🇳🇵", "NL": "🇳🇱", "NC": "🇳🇨", "NZ": "🇳🇿", "NI": "🇳🇮",
    "NE": "🇳🇪", "NG": "🇳🇬", "NU": "🇳🇺", "NF": "🇳🇫", "MP": "🇲🇵",
    "NO": "🇳🇴", "OM": "🇴🇲", "PK": "🇵🇰", "PW": "🇵🇼", "PS": "🇵🇸",
    "PA": "🇵🇦", "PG": "🇵🇬", "PY": "🇵🇾", "PE": "🇵🇪", "PH": "🇵🇭",
    "PN": "🇵🇳", "PL": "🇵🇱", "PT": "🇵🇹", "PR": "🇵🇷", "QA": "🇶🇦",
    "RE": "🇷🇪", "RO": "🇷🇴", "RU": "🇷🇺", "RW": "🇷🇼", "BL": "🇧🇱",
    "SH": "🇸🇭", "KN": "🇰🇳", "LC": "🇱🇨", "MF": "🇲🇫", "PM": "🇵🇲",
    "VC": "🇻🇨", "WS": "🇼🇸", "SM": "🇸🇲", "ST": "🇸🇹", "SA": "🇸🇦",
    "SN": "🇸🇳", "RS": "🇷🇸", "SC": "🇸🇨", "SL": "🇸🇱", "SG": "🇸🇬",
    "SX": "🇸🇽", "SK": "🇸🇰", "SI": "🇸🇮", "SB": "🇸🇧", "SO": "🇸🇴",
    "ZA": "🇿🇦", "GS": "🇬🇸", "SS": "🇸🇸", "ES": "🇪🇸", "LK": "🇱🇰",
    "SD": "🇸🇩", "SR": "🇸🇷", "SJ": "🇸🇯", "SZ": "🇸🇿", "SE": "🇸🇪",
    "CH": "🇨🇭", "SY": "🇸🇾", "TW": "🇹🇼", "TJ": "🇹🇯", "TZ": "🇹🇿",
    "TH": "🇹🇭", "TL": "🇹🇱", "TG": "🇹🇬", "TK": "🇹🇰", "TO": "🇹🇴",
    "TT": "🇹🇹", "TN": "🇹🇳", "TR": "🇹🇷", "TM": "🇹🇲", "TC": "🇹🇨",
    "TV": "🇹🇻", "UG": "🇺🇬", "UA": "🇺🇦", "AE": "🇦🇪", "GB": "🇬🇧",
    "US": "🇺🇸", "UM": "🇺🇲", "UY": "🇺🇾", "UZ": "🇺🇿", "VU": "🇻🇺",
    "VE": "🇻🇪", "VN": "🇻🇳", "VG": "🇻🇬", "VI": "🇻🇮", "WF": "🇼🇫",
    "EH": "🇪🇭", "YE": "🇾🇪", "ZM": "🇿🇲", "ZW": "🇿🇼"
};


    // Mendapatkan emoji bendera berdasarkan kode negara
    const flagEmoji = countryFlags[countryCode] || "";

    // Pesan yang akan dikirim
    const message = `IP: ${visitorIP}\nWaktu Kunjungan (WITA): ${visitTime}\nNegara: ${flagEmoji}`;

    // URL endpoint untuk mengirim pesan ke bot API Telegram
    const url = `https://api.telegram.org/bot${botToken}/sendMessage`;

    // Data yang akan dikirim dalam permintaan POST
    const data = {
      chat_id: chatID,
      text: message
    };

    // Mengirim permintaan POST ke bot API Telegram
    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(responseData => console.log(responseData))
      .catch(error => console.error('Terjadi kesalahan:', error));
  })
  .catch(error => console.error('Terjadi kesalahan saat mengambil data IP:', error));
  