<x-app-layout>
    @foreach ($employees as $employee)
        {{ $employee['nombre'] }}
    @endforeach
</x-app-layout>