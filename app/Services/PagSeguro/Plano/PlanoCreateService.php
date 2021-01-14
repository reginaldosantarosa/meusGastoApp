<?php


namespace App\Services\PagSeguro\Plano;


use App\Services\PagSeguro\Credentials;
use Illuminate\Support\Facades\Http;

class PlanoCreateService
{
    public function makeRequest(array $data)
    {
        $url=Credentials::getCredentials('/pre-approvals/request/');
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
            'Content-Type' => 'application/json'
        ])
            -> post($url,
                [
                    'reference' => $data['slug'],
                    'preApproval' =>  [
                        'name' => $data['nome'],
                        'charge' => 'AUTO' ,
                        'period'=> 'MONTHLY',
                        'amountPerPayment' => $data['valor']/100 ,
                    ]
                ]
            );

        return $response->json()['code'];
    }

}
