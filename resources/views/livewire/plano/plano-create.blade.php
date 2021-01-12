<div class="max-w-7xl mx-auto py-15 px-4">

    <x-slot name="header">Criar Plano</x-slot>

    @include('includes.message')

    <form action="" wire:submit.prevent="createPlano" class="w-full max-w-7xl mx-auto py-10">
        <div class="flex flex-wrap -mx-3 mb-6">

            <p class="w-full px-3 mb-6 md:mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nome Plano</label>
                <input type="text" name="nome" wire:model="plano.nome"
                       class="block appearance-none w-full bg-gray-200 border @error('plano.nome') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('plano.nome')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>

            <p class="w-full px-3 mb-6 md:mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descrição Plano</label>
                <input type="text" name="descricao" wire:model="plano.descricao"
                       class="block appearance-none w-full bg-gray-200 border @error('plano.descricao') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('plano.descricao')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>


            <p class="w-full px-3 mb-6 md:mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Valor do Plano</label>
                <input type="text" name="valor" wire:model="plano.valor"
                       class="block appearance-none w-full bg-gray-200 border @error('plano.price') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">


            @error('plano.valor')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror

            </p>

            <p class="w-full px-3 mb-6 md:mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Apelido Plano</label>

                <input type="text" name="slug" wire:model="plano.slug"
                       class="block appearance-none w-full bg-gray-200 @error('plano.slug') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            @error('plano.slug')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror

            </p>

        </div>
        <div class="w-full py-4 px-3 mb-6 md:mb-6">

            <button type="submit"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Criar Plano</button>
        </div>

    </form>
</div>
