<x-app-layout>
    <x-slot name="header">
        

    <div class="py-6 px-6" x-data="{ }">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Lista de Transações</h1>
            <a href="{{ route('transactions.create') }}"
               class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-600">
                Nova Transação
            </a>
        </div>

        <table class="w-full border-collapse bg-white rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 text-left">Data</th>
                    <th class="p-2 text-left">Valor</th>
                    <th class="p-2 text-right">Opções</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr class="border-b">
                        {{-- Coluna 1: Data/Hora (clicável para VER) --}}
                        <td class="p-2">
                            <a href="{{ route('transactions.show', $transaction) }}"
                               class="hover:underline">
                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                            </a>
                        </td>

                        {{-- Coluna 2: Valor --}}
                        <td class="p-2">
                            R$ {{ number_format($transaction->valor, 2, ',', '.') }}
                        </td>

                        {{-- Coluna 3: Menu ⋮ com Ver/Editar/Excluir --}}
                        <td class="p-2 text-right">
                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                <button
                                    @click="open = !open"
                                    @click.outside="open = false"
                                    class="px-2 py-1 border border-gray-300 rounded hover:bg-gray-100"
                                    aria-label="Opções"
                                    title="Opções"
                                >
                                    ⋮
                                </button>

                                <div
                                    x-show="open"
                                    x-transition
                                    class="absolute right-0 mt-2 w-40 rounded-md border bg-white shadow-lg z-10 overflow-hidden"
                                >
                                    <a href="{{ route('transactions.show', $transaction) }}"
                                       class="block px-4 py-2 hover:bg-gray-50">
                                        Ver
                                    </a>

                                    <a href="{{ route('transactions.edit', $transaction) }}"
                                       class="block px-4 py-2 hover:bg-gray-50">
                                        Editar
                                    </a>

                                    <form method="POST" action="{{ route('transactions.destroy', $transaction) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Deseja excluir esta transação?')"
                                            class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50"
                                        >
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Nenhuma transação encontrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
    </x-slot>
</x-app-layout>
