<?php

namespace App\Http\Livewire\Plano;

use App\Models\Plano;
use App\Services\PagSeguro\Plano\PlanoCreateService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;


class PlanoCreate extends Component
{
    public array $plano=[];


    public $nome;
    public $descricao;
    public $valor;
    public $slug;

    protected $rules = [
        'plano.valor' => 'required',
        'plano.nome'   => 'required',
        'plano.descricao' => 'required',
        'plano.slug'=> 'required',

    ];


    public function createPlano(){


        $this->validate();

        $plano = $this->plano;

        $planPagSeguroReference = (new PlanoCreateService())->makeRequest($plano);

        $plano['referencia'] = $planPagSeguroReference;
        //$plano['referencia'] = "MERCADO_SEGURO";

        Plano::create($plano);

        $this->plano = [];

        session()->flash('message', 'Plano Criado com Sucesso');
    }


    public function render()
    {

        return view('livewire.plano.plano-create');
    }
}
