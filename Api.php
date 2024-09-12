<?php

Class Api{

    public static function returnApi() {
         
        $ch = curl_init("https://api.bcb.gov.br/dados/serie/bcdata.sgs.1/dados/ultimos");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = (curl_exec($ch));
        $dolar = json_decode($response, true);
        curl_close($ch);
        
        
        return($dolar[0]['valor']);
        
    }
}