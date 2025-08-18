<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Transação') }}
        </h2>
    </x-slot>

    {{-- mensagens de sucesso/erro, se você tiver o componente <x-flash /> --}}
    @if (function_exists('view') && view()->exists('components.flash'))
        <x-flash />
    @endif

    <div class="py-6 px-6 max-w-lg mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="valor" class="block text-gray-700 font-medium mb-2">Valor (R$):</label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        inputmode="decimal"
                        name="valor"
                        id="valor"
                        value="{{ old('valor', $transaction->valor) }}"
                        class="w-full rounded border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        autofocus
                    >
                    @error('valor')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('transactions.index') }}"
                       class="px-4 py-2 border rounded hover:bg-gray-100">
                        Voltar
                    </a>

                    <div class="flex gap-2">
                        <a href="{{ route('transactions.show', $transaction) }}"
                           class="px-4 py-2 bg-gray-200 text-black rounded hover:bg-gray-300">
                            Ver
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Atualizar
                        </button>
                    </div>
                </div>
            </form>

            {{-- (Opcional) Excluir direto da tela de edição --}}
