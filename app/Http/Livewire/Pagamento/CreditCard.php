<?php

namespace App\Http\Livewire\Pagamento;


use App\Models\{User,Plano};
use App\Services\PagSeguro\Credentials;
use App\Services\PagSeguro\Subscription\SubscriptionService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreditCard extends Component
{
    public $sessionId;

    public Plano $plano;

    protected  $listeners = [
        'paymentData' =>'proccessSubscription'
    ];

    public function mount()
    {
        $email =config('pagseguro.email');
        $token = config('pagseguro.token');
        $url=Credentials::getCredentials('/sessions/');

        $response = Http::post($url);
        $response=simplexml_load_string($response->body());
        $this->sessionId = (string) $response->id;

    }


    public function proccessSubscription($data){

        $data['plan_reference'] = $this->plano->referencia;
        $makeSubscription = (new SubscriptionService($data))->makeSubscription();

        $user = auth()->user();

        $user->plano()->create([
            'plano_id' => $this->plano->id,
            'status'  => $makeSubscription['status'],
            'data_inscricao' => (\DateTime::createFromFormat(DATE_ATOM, $makeSubscription['date']))->format('Y-m-d H:i:s'),
            'referencia_transacao' => $makeSubscription['code'],
        ]);

        session()->flash('message', 'Plano Aderido com Sucesso');
        $this->emit('subscriptionFinished');


    }

    public function render()
    {
        return view('livewire.pagamento.credit-card')->layout('layouts.front');
    }
}
