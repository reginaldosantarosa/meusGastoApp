<div class="max-w-7xl mx-auto py-15 px-4" x-data="creditCard()" x-init="PagSeguroDirectPayment.setSessionId('{{$sessionId}}')">

    @include('includes.message')

    <div class="flex flex-wrap -mx-3 mb-6">

        <h2 class="w-full px-3 mb-6 border-b-2 border-cool-gray-800 pb-4">
            Realizar Pagamento Assinatura - Plano Escolhido {{$plano->nome}} - {{$sessionId}}
        </h2>
    </div>

    <form action="" name="creditCard" class="w-full max-w-7xl mx-auto">

        <div class="flex flex-wrap -mx-3 mb-6">

            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Número Cartão</label>
                <input type="text" x-on:keyup="getBrand" name="card_number" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb2">Nome Cartão</label>
                <input type="text" name="card_name" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

        </div>

        <div class="flex -mx-3">

            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb2">Mês Vencimento</label>
                <input type="text" name="card_month" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb2">Ano Vencimento</label>
                <input type="text" name="card_year" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

        </div>

        <div class="flex flex-wrap -mx-3 mb-6">

            <p class="w-full px-3 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb2">Código de Segurança</label>
                <input type="text" name="card_cvv" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

            <p class="w-full py-4 px-3 mb-6">
                <button type="submit" x-on:click.prevent="cardToken"
                        class="flex-shrink-0 bg-green-700 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-2 px-6 rounded">Realizar Assinatura</button>
            </p>

        </div>

    </form>

    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">  </script>
    <script>
        function creditCard() {
            return {
                brandName:'',
                getBrand(e) {
                    console.log('cu' + e.target.value)
                    let cardNumber = e.target.value;
                    if (cardNumber.length == 6) {
                        console.log('entrou')
                        PagSeguroDirectPayment.getBrand({
                            cardBin: cardNumber,
                            success: (response) => {
                                this.brandName = response.brand.name
                            },
                            error: function(response) {
                                //tratamento do erro

                            },
                            complete: function(response) {
                                //tratamento comum para todas chamadas
                            }
                        });
                    }

                },

                cardToken(e){
                    let button = e.target;
                    button.disabled=true
                    button.classList.add('cursor-not-allowed','disabled:opacity-25')
                    button.textContent = "Carregando...."

                    console.log('entrou cardToken')
                    let formEl = document.querySelector('form[name=creditCard]');
                    let forData = new FormData(formEl);

                    PagSeguroDirectPayment.createCardToken({
                        cardNumber: forData.get('card_number'),
                        brand: this.brandName ,
                        cvv: forData.get('card_cvv'),
                        expirationMonth: forData.get('card_month'),
                        expirationYear: forData.get('card_year'),

                        success: function(response) {
                            let payloud = {
                                'token': response.card.token,
                                'senderHash': PagSeguroDirectPayment.getSenderHash()
                            }
                            console.log(payloud)

                            Livewire.emit('paymentData', payloud)
                            Livewire.on('subscriptionFinished', result =>  {
                                formEl.reset();
                                location.href = '{{route('dashboard')}}';
                            });
                        },
                        error: function(response) {
                            console.log(response)
                        },
                        complete: function(response) {
                            // Callback para todas chamadas.
                        }
                    });

                }
            }

        }
    </script>
</div>
