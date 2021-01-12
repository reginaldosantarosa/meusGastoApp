<?php


namespace App\Services\PagSeguro\Plano;


use Illuminate\Support\Facades\Http;

class PlanoCreateService
{
       public function __construct(){
                $this->email =config('pagseguro.email');
                $this->token = config('pagseguro.token');
        }

    public function makeRequest(array $data){
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
            'Content-Type' => 'application/json'
        ])
            -> post("https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request/?email={$this->email}&token={$this->token}",
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
