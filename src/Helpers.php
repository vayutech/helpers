<?php

namespace Vayutech;

class Helpers
{

    // peguei no site do serasa, ao completar meu perfil
    public $brazillianSchooling = [
        'FUNDAMENTAL_COMPLETO' => 'Fundamental Completo',
        'FUNDAMENTAL_INCOMPLETO' => 'Fundamental Incompleto',
        'MEDIO_COMPLETO' => 'Médio Completo',
        'MEDIO_INCOMPLETO' => 'Médio Incompleto',
        'SUPERIOR_COMPLETO' => 'Superior Completo',
        'SUPERIOR_INCOMPLETO' => 'Superior Incompleto',
        'POS_GRADUACAO_COMPLETA' => 'Pós-Graduação Completa',
        'POS_GRADUACAO_INCOMPLETA' => 'Pós-Graduação Incompleta',
    ];

    // peguei no site do IBGE
    // https://educa.ibge.gov.br/jovens/conheca-o-brasil/populacao/18319-cor-ou-raca.html
    public $brazillianRaces = [
        'BRANCA' => 'Branca',
        'PRETA' => 'Preta',
        'PARDA' => 'Parda',
        'AMARELA' => 'Amarela',
        'INDIGENA' => 'Indígena',
    ];

    public function getBrazillianSchooling($value)
    {
        return $this->brasilianScholing[$value];
    }

    public function getBrazillianRaces($value)
    {
        return $this->brazilianRaces[$value];
    }

    public static function shortName($name)
    {
        $name = trim($name);
        if(strstr($name, "/"))
            return $name;
        else{
            $array_name = explode(" ", $name);
            $names = count($array_name);
            return $array_name[0] . " " . $array_name[$names - 1];
        }
    }

    public static function cpfNumber($cpf)
    {
        $cpf = str_replace(['.', '-', ' '], '', $cpf);
        if(!is_numeric($cpf))
            $cpf = null;
        else
            $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        return $cpf;
    }

    public static function cpfMask($cpf)
    {
        return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
    }

    public static function cnpjNumber($cnpj)
    {
        $cnpj = str_replace(['.', '-', ' ', '/'], '', $cnpj);
        if(!is_numeric($cnpj))
            $cnpj = null;
        else
            $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
        return $cnpj;
    }

    public static function cnpjMask($cnpj)
    {
        return 
            substr($cnpj, 0, 2) . "."
            . substr($cnpj, 2, 3) . "."
            . substr($cnpj, 5, 3) . "/"
            . substr($cnpj, 8, 4) . "-"
            . substr($cnpj, 12, 2);
    }

    public static function nameToArray($name)
    {
        $name = trim($name);
        $name_array = explode(" ", $name);
        $first_name = $name_array[0];
        $last_name = $name_array[count($name_array) - 1];
        if(count($name_array) > 2)
            $middle_name = implode(" ", array_slice($name_array, 1, count($name_array) -2));
        else
            $middle_name = " ";
        return [
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name
        ];
    }

    public static function dateToDatabase($date_test)
    {
        $date = explode('/', $date_test);
        if(count($date) == 3)
            return $date[2] . "-" . $date[1] . "-" . $date[0];
        else
            return $date_test;
    }

    public static function dateToForm($date_test)
    {
        $date = explode('-', $date_test);
        if(count($date) == 3)
            return $date[2] . "/" . $date[1] . "/" . $date[0];
        else
            return $date_test;
    }

    public static function dateTimeToDatabase($date_test)
    {
        $date = explode(' ', $date_test);
        if(count($date) == 2)
            return self::dateToDatabase($date[0]) . " " . $date[1];
        else
            return $date_test;
    }

    public static function dateTimeToForm($date_test)
    {
        $date = explode(' ', $date_test);
        if(count($date) == 2)
            return self::dateToForm($date[0]) . " " . $date[1];
        else
            return $date_test;
    }

    public static function shortDateTime($date_test)
    {
        $date = explode(' ', $date_test);
        $_date = $date[0]; 
        $_time = $date[1];
        $_date = explode('-', $_date);
        $_date = $_date[2] . "/" . $_date[1];
        $_time = explode(':', $_time);
        $_time = $_time[0] . ":" . $_time[1];
        return $_date . " " . $_time;
    }

    public static function cpfRandom($mascara = "1") {
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = rand(0, 9);
        $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
        $d1 = 11 - (mod($d1, 11) );
        if ($d1 >= 10) {
            $d1 = 0;
        }
        $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
        $d2 = 11 - (mod($d2, 11) );
        if ($d2 >= 10) {
            $d2 = 0;
        }
        $retorno = '';
        if ($mascara == 1) {
            $retorno = '' . $n1 . $n2 . $n3 . "." . $n4 . $n5 . $n6 . "." . $n7 . $n8 . $n9 . "-" . $d1 . $d2;
        } else {
            $retorno = '' . $n1 . $n2 . $n3 . $n4 . $n5 . $n6 . $n7 . $n8 . $n9 . $d1 . $d2;
        }
        return $retorno;
    }

    public static function getTimeSeconds($time) {
        $temp = explode(':', $time);
        $n = count($temp);
        if($n == 0)
            return $time;
        if ($n == 1) {
            $g = 0;
            $i = 0;
            $s = $temp[0];
        } elseif ($n == 2) {
            $g = 0;
            $i = $temp[0];
            $s = $temp[1];
        } elseif ($n == 3) {
            $g = $temp[0];
            $i = $temp[1];
            $s = $temp[2];
        }
        return ($g * 3600) + ($i * 60) + $s;
    }

    public static function getTimeHours($hora, $formato = null) {
        $s = $hora;
        $mm = round(($s - (int) $s) * 1000, 0);
        $mm = str_pad($mm, 3, "0", STR_PAD_LEFT);
        $s = (int) $s;

        if ($s >= 3600) {
            $h = floor($s / 3600);
            $s -= $h * 3600;
        } else
            $h = 0;

        if ($s >= 60) {
            $m = floor($s / 60);
            $s -= $m * 60;
        }
        else
            $m = 0;

        $m = str_pad($m, 2, "0", STR_PAD_LEFT);
        $s = str_pad($s, 2, "0", STR_PAD_LEFT);

        if ($formato == 'cr') {
            if ($h)
                return "{$h}h{$m}'{$s}''{$mm}";
            else
                return "{$m}'{$s}''{$mm}";
        }
        elseif ($formato == 'et') {
            if ($h)
                return "{$h}h{$m}'{$s}";
            else
                return "{$m}'{$s}";
        }
        elseif ($formato == 'dif') {
            if ($h)
                return "+{$h}h{$m}'{$s}''";
            else
                return "+{$m}'{$s}''";
        }
    }

    #https://gist.github.com/mahdiyazdani/a57686e0f39cb98e24d1b4841a03342c

    /**
      * Retrieve the next key in an array from given key.
      *
      * @since    1.0.0
      * @param    array   $arr        List of items in a form of array.
      * @param    integer $key        Key to search and find within the array.
      * @return   integer
    */
    public static function prefix_get_next_key_array( $arr, $key ) {
	    $keys = array_keys( $arr );
	    $position = array_search( $key, $keys, true );

	    if ( isset( $keys[ $position + 1 ] ) ) {
		    $next_key = $keys[ $position + 1 ];
	    } else 
            $next_key = $key;

	    return $next_key;
    }
    
}