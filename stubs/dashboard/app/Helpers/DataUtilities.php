<?php

namespace App\Helpers;

class DataUtilities
{

    public static function arrayStringify(array $array, string $separator = ","): string
    {
        return implode($separator, array_filter(array_unique($array)));
    }

    public static function arrayParse(string $string, string $separator = ","): array
    {
        return explode($separator, $string);
    }

    public static function numbersOnlyClean(string $string): string
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    public static function stringValueToFloatValueConversion(string $value): float
    {
        return floatval(str_replace(',', '.', str_replace('.', '', $value)));
    }

    public static function valid_email($address)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
    }

    public static function humanize($str)
    {
        return ucwords(str_replace('_', ' ', trim($str)));
    }

    public static function onlyNumbers($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

    public static function geraSenha()
    {
        $tamanho = 8;
        $maiusculas = true;
        $numeros = true;
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getContentTypes()
    {

        $contentTypes = [
            'application/EDI-X12',
            'application/EDIFACT',
            'application/javascript',
            'application/octet-stream',
            'application/ogg',
            'application/pdf',
            'application/xhtml+xml',
            'application/x-shockwave-flash',
            'application/json',
            'application/ld+json',
            'application/xml',
            'application/zip',
            'application/x-www-form-urlencoded',
            'audio/mpeg',
            'audio/x-ms-wma',
            'audio/vnd.rn-realaudio',
            'audio/x-wav',
            'image/gif',
            'image/jpeg',
            'image/png',
            'image/tiff',
            'image/vnd.microsoft.icon',
            'image/x-icon',
            'image/vnd.djvu',
            'image/svg+xml',
            'multipart/mixed',
            'multipart/alternative',
            'multipart/related',
            'multipart/form-data',
            'text/css',
            'text/csv',
            'text/html',
            'text/javascript',
            'text/plain',
            'text/xml',
            'video/mpeg',
            'video/mp4',
            'video/quicktime',
            'video/x-ms-wmv',
            'video/x-msvideo',
            'video/x-flv',
            'video/webm',
            'application/vnd.oasis.opendocument.text',
            'application/vnd.oasis.opendocument.spreadsheet',
            'application/vnd.oasis.opendocument.presentation',
            'application/vnd.oasis.opendocument.graphics',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.mozilla.xul+xml'
        ];

        return $contentTypes;
    }

    public static function getMethodsTypes()
    {
        $methodsTypes = [
            'CONNECT',
            'DELETE',
            'GET',
            'HEAD',
            'OPTIONS',
            'PATCH',
            'POST',
            'PUT',
            'TRACE'
        ];
        return $methodsTypes;
    }

    public static function getFieldsTypes()
    {
        $fieldsTypes = [
            'INTEIRO',
            'BOOLEAN',
            'DECIMAL',
            'VARCHAR',
            'BLOB',
            'TEXT',
            'TIME',
            'DATE',
            'YEAR',
            'DATETIME'
        ];
        return $fieldsTypes;
    }

    public static function prettyPrint($json)
    {
        $result = $html = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen($json);

        for ($i = 0; $i < $json_length; $i++) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if ($ends_line_level !== NULL) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ($in_escape) {
                $in_escape = false;
            } else if ($char === '"') {
                $in_quotes = !$in_quotes;
            } else if (!$in_quotes) {
                switch ($char) {
                    case '}':
                    case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;

                    case '{':
                    case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ":
                    case "\t":
                    case "\n":
                    case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            } else if ($char === '\\') {
                $in_escape = true;
            }
            if ($new_line_level !== NULL) {
                $result .= "\n" . str_repeat("\t", $new_line_level);
            }
            $result .= $char . $post;
        }
        return $result;
    }

    public static function curlPost($url = '', $headers = [], $authorization, $data = [], $ssl = 0)
    {

        $header = [];

        foreach (json_decode($headers, true) as $key => $value){
            if(!empty($value)){
                if($key == 'Authorization'){
                    $value = $authorization;
                }
                $header[] = "$key:$value";
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $ssl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        $response = curl_exec($ch);
        //dd(curl_error($ch));
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_len);
        $body = substr($response, $header_len);
        curl_close($ch);
        return [
            'response' => $body,
            'header' => $header,
            'httpcode' => $httpcode
        ];
    }

    public static function curlGet($url = '', $headers = [], $authorization, $data = [], $ssl = 0)
    {

        if(count($data)){
            $query = http_build_query($data);
            $url = $url."?".$query;
        }

        $header = [];
        foreach (json_decode($headers, true) as $key => $value){
            if($key == 'Authorization'){
                $value = $authorization;
            }
            $header[] = "$key:$value";
        }

       // $headers = [
           // 'X-Apple-Tz: 0',
           // 'X-Apple-Store-Front: 143444,12',
           //'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
           //'Accept-Encoding: gzip, deflate',
           //'Accept-Language: en-US,en;q=0.5',
           // 'Cache-Control: no-cache',
           // 'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
           // 'Host: www.example.com',
           // 'Referer: http://www.example.com/index.php', //Your referrer address
           // 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
           // 'X-MicrosoftAjax: Delta=true'
      //  ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $ssl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        $response = curl_exec($ch);
        //dd(curl_error($ch));
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_len);
        $body = substr($response, $header_len);
        curl_close($ch);
        return [
            'response' => $body,
            'header' => $header,
            'httpcode' => $httpcode
        ];
    }
}
