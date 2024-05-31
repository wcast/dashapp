<?php

namespace App\Helpers;


class DataFormat
{

    public static function formata_cpf_cnpj($cpf_cnpj){

        /**
            Pega qualquer CPF e CNPJ e formata
            CPF: 000.000.000-00
            CNPJ: 00.000.000/0000-00
        */

        $cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);

        $tipo_dado = NULL;

        if(strlen($cpf_cnpj)==11){
            $tipo_dado = "cpf";
        }

        if(strlen($cpf_cnpj)==14){
            $tipo_dado = "cnpj";
        }

        switch($tipo_dado){
            default:
                $cpf_cnpj_formatado = "";
                break;

            case "cpf":
                $bloco_1 = substr($cpf_cnpj,0,3);
                $bloco_2 = substr($cpf_cnpj,3,3);
                $bloco_3 = substr($cpf_cnpj,6,3);
                $dig_verificador = substr($cpf_cnpj,-2);
                $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;
                break;

            case "cnpj":
                $bloco_1 = substr($cpf_cnpj,0,2);
                $bloco_2 = substr($cpf_cnpj,2,3);
                $bloco_3 = substr($cpf_cnpj,5,3);
                $bloco_4 = substr($cpf_cnpj,8,4);
                $digito_verificador = substr($cpf_cnpj,-2);
                $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."/".$bloco_4."-".$digito_verificador;
                break;
        }
        return $cpf_cnpj_formatado;
    }

    public static function formataCelular($phoneNumber){
      $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);
       if(strlen($phoneNumber) == 11) {
            $areaCode = substr($phoneNumber, 0, 2);
            $nextThree = substr($phoneNumber, 2, 5);
            $lastFour = substr($phoneNumber, 7, 9);

            $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
        } else if(strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);

            $phoneNumber = $nextThree.'-'.$lastFour;
        }
        return $phoneNumber;
    }

    public static function formataData($data){
        return date("d/m/Y", strtotime($data));
    }

}
