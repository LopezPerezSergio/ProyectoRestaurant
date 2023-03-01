<x-app-layout>
    <x-siderbar>
        <p>hola mesas</p>

        @foreach($tables as $table)
         nombre:  {{ $table['nombre'] }}
        @endforeach




    </x-siderbar>

</x-app-layout>