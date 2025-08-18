<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Transação') }}
        </h2>
    </x-slot>

    {{-- mensagens de sucesso/erro se você tiver o componente --}}
    @if (function_exists('view') && view()->exists('components.flash'))
        <x-flash />
    @endif

    <div class="py-6 px-6 max-w-lg mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('transactions.store') }}" method="POST" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="valor" class="block text-gray-700 font-medium mb-2">Valor (R$):</label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        inputmode="decimal"
                        name="valor"
                        id="valor"
                        value="{{ old('valor') }}"
                        class="w-full rounded border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        autofocus
                    >
                    @error('valor')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('transactions.index') }}"
                       class="px-4 py-2 border rounded hover:bg-gray-100">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
