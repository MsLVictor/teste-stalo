<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Transação') }}
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-lg mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Valor</h3>
                <p class="text-gray-900">
                    R$ {{ number_format($transaction->valor, 2, ',', '.') }}
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700">Criada em</h3>
                <p class="text-gray-900">
                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            @if($transaction->updated_at && $transaction->updated_at != $transaction->created_at)
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Última atualização</h3>
                    <p class="text-gray-900">
                        {{ $transaction->updated_at->format('d/m/Y H:i') }}
                    </p>
                </div>
            @endif

            <div class="flex justify-between items-center pt-4 border-t">
                <a href="{{ route('transactions.index') }}"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Voltar
                </a>

                <div class="flex gap-2">
                    <a href="{{ route('transactions.edit', $transaction) }}"
                       class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Editar
                    </a>
                    <form method="POST"
                          action="{{ route('transactions.d
