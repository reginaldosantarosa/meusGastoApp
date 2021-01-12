<div class="max-w-7xl mx-auto py-15 px-4">

    <x-slot name="header">
        Criar Registro
    </x-slot>

    @include('includes.message')

    <form action="" wire:submit.prevent="createDespesa" class="w-full max-w-7xl mx-auto py-10 ">
        <div class="flex flex-wrap -mx-3 mb-6">

            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descrição Registro</label>
                <input type="text" name="descricao" wire:model="descricao"
                class="block appearance-none w-full bg-gray-200 border @error('descricao') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('descricao')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>


            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Valor do Registro</label>
                <input type="text" name="valor" wire:model="valor"
                class="block appearance-none w-full bg-gray-200 border @error('valor') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            @error('valor')
            <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>


            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo do Registro</label>
                <select name="type" id="" wire:model="type" class="block appearance-none w-full bg-gray-200 border @error('type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Selecione o tipo do registro: Entrada ou Saída...</option>
                    <option value="1">Entrada</option>
                    <option value="2">Saída</option>
                </select>

            @error('type')
             <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
            </p>

            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Comprovante Registro</label>
                <input type="file" name="foto" wire:model="foto"
                       class="block appearance-none w-full bg-gray-200 border @error('foto') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                @if($foto)
                    <img src="{{$foto->temporaryUrl()}}" alt="" width="150" class="my-3">
            @endif

                @error('foto')
                <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
                @enderror

            </p>


            <p class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data do Comprovante, pode deixar em branco se o dia for hoje.</label>

                <input type="text" name="despesa_data" wire:model="despesa_data"
                       class="block appearance-none w-full bg-gray-200 border border-gray-200  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

        </div>
        <div class="w-full py-4 px-3 mb-6 md:mb-0">

            <button type="submit"
                        class="flex-shrink-0 bg-green-500 hover:bg-green-900 border-green-700 hover:border-green-900 text-sm border-4 text-white py-2 px-2 rounded"
                    {{--class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"--}}>Criar Registro</button>
        </div>

    </form>
</div>
