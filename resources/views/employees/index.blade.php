<x-app-layout>
    <x-siderbar>
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 sm:rounded-lg">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                    <x-slot name="title">
                        Modulo de Empleado
                    </x-slot>

                    @if (session('alert'))
                        <x-slot name="alert">
                            <x-alert>{{ session('alert') }}</x-alert>
                        </x-slot>
                    @endif

                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        {{-- entrada de busqueda --}}
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Buscar empleado" required="">
                                </div>
                            </form>
                        </div>

                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <!-- BOTON MODAL -->
                            <button id="createModalButton" data-modal-toggle="createModal" type="button"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Agregar Empleado
                            </button>

                            <!-- ACTIONS AND FILTER -->
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                {{-- bonon de acciones --}}
                                <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    type="button">
                                    <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                    Actions
                                </button>

                                {{-- Lista de acciones --}}
                                <div id="actionsDropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="actionsDropdownButton">
                                        <li>
                                            <a href="#"
                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass
                                                Edit</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="#"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                            all</a>
                                    </div>
                                </div>

                                {{-- Boton de filtro --}}
                                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Filter
                                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                    </svg>
                                </button>

                                {{-- Lista de filtracion --}}
                                <div id="filterDropdown"
                                    class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand
                                    </h6>
                                    <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                        <li class="flex items-center">
                                            <input id="apple" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="apple"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple
                                                (56)</label>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- FIN -->
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">NOMBRE</th>
                                    <th scope="col" class="px-4 py-3">APELLIDOS</th>
                                    <th scope="col" class="px-4 py-3">TELEFONO</th>
                                    <th scope="col" class="px-4 py-3">SUELDO</th>
                                    <th scope="col" class="px-4 py-3">Codigo Acceso</th> 
                                    <th scope="col" class="px-4 py-3">ESTADO</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $employee['nombre'] }}
                                        </th>
                                        <td class="px-4 py-3">{{ $employee['apellidos'] }}</td>
                                        <td class="px-4 py-3">{{ $employee['telefono'] }}</td>
                                        <td class="px-4 py-3">${{ $employee['sueldo'] }}</td>
                                        <td class="px-4 py-3">{{ $employee['codigoAcceso'] }}</td>
                                        <td class="px-4 py-3">{{ $employee['status'] == '1' ? 'Activo' : 'Inactivo' }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="{{ $employee['id'] }}-dropdown-button"
                                                data-dropdown-toggle="{{ $employee['id'] }}-dropdown"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>

                                            <div id="{{ $employee['id'] }}-dropdown"
                                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="{{ $employee['id'] }}-dropdown-button">
                                                    <li>
                                                        {{-- boton de modal show --}}
                                                        <button id="show{{ $employee['id'] }}ModalButton"
                                                            data-modal-toggle="show{{ $employee['id'] }}Modal"
                                                            type="button"
                                                            class=" w-full block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Ver
                                                        </button>
                                                    </li>
                                                    <li>
                                                        {{-- boton de modal edit --}}
                                                        <button id="edit{{ $employee['id'] }}ModalButton"
                                                            data-modal-toggle="edit{{ $employee['id'] }}Modal"
                                                            type="button"
                                                            class=" w-full block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Editar
                                                        </button>
                                                    </li>
                                                </ul>
                                                <div class="py-1">
                                                    <a href="#"
                                                        class="block py-2 px-4 text-sm text-red-700 hover:bg-red-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-red">Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- modal create employee -->
        <div id="createModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Nuevo Empleado
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="createModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Cerrar</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf

                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="nombre"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                <input type="text" name="nombre" id="nombre"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Nombre" required="">
                            </div>
                            <div>
                                <label for="apellidos"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Product brand" required="">
                            </div>
                            <div>
                                <label for="telefono"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                                <input type="text" name="telefono" id="telefono"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Product brand" required="">
                            </div>
                            <div>
                                <label for="sueldo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sueldo</label>
                                <input type="number" name="sueldo" id="sueldo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="$2999" required="">
                            </div>
                            <div>
                                
                                <label for="codigoAcceso" 
                                 @if($errors->first('codigoAcceso'))
                                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{$errors->first('codigoAcceso')}}</span>Ingrese los datos correctos</p>
                                    @endif
                                    >codigoAcceso</label>
                                    <input type="text" name="codigoAcceso" id="codigoAcceso" value="{{old('codigoAcceso')}}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="codigoAcceso" required="">
                                </div> 
                            <div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input name="status" id="status" type="checkbox" value="1"
                                        class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Estado
                                    </span>
                                </label>

                            </div>

                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Agregar Nuevo Empleado
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Show --}}
        @foreach ($employees as $employee)
            <x-modal-show>
                <x-slot name="modal">
                    {{ $employee['id'] }}
                </x-slot>
                <x-slot name="title">
                    Empleado:{{ $employee['nombre'] }}
                </x-slot>

                <div>
                    <label for="nombre"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nombre" required="" value="{{ $employee['nombre'] }}" disabled>
                </div>

                <div>
                    <label for="apellidos"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Product brand" required="" value="{{ $employee['apellidos'] }}" disabled>
                </div>

                <div>
                    <label for="telefono"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                    <input type="text" name="telefono" id="telefono"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Product brand" required="" value="{{ $employee['telefono'] }}" disabled>
                </div>

                <div>
                    <label for="sueldo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sueldo</label>
                    <input type="number" name="sueldo" id="sueldo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="$2999" required="" value="{{ $employee['sueldo'] }}" disabled>
                </div>

                <div>
                    <label for="codigoAcceso"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">codigoAcceso</label>
                    <input type="number" name="codigoAcceso" id="codigoAcceso"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="$2999" required="" value="{{ $employee['codigoAcceso'] }}" disabled>
                </div>

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input name="status" id="status" type="checkbox" value="1" class="sr-only peer"
                            @if ($employee['status'] == '1') checked @endif disabled>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Estado
                        </span>
                    </label>
                </div>

            </x-modal-show>
        @endforeach

        {{-- Modal Edit --}}
        @foreach ($employees as $employee)
            <x-modal-edit>
                <x-slot name="modal">
                    {{ $employee['id'] }}
                </x-slot>

                <x-slot name="url">
                    {{ route('employee.update', $employee['id']) }}
                </x-slot>

                <x-slot name="title">
                    Editar Empleado
                </x-slot>

                {{-- Datos para la actualizacion --}}
                <div>
                    <label for="nombre"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nombre" required="" value="{{ $employee['nombre'] }}">
                </div>

                <div>
                    <label for="apellidos"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Product brand" required="" value="{{ $employee['apellidos'] }}">
                </div>

                <div>
                    <label for="telefono"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono</label>
                    <input type="text" name="telefono" id="telefono"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Product brand" required="" value="{{ $employee['telefono'] }}">
                </div>

                <div>
                    <label for="sueldo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sueldo</label>
                    <input type="number" name="sueldo" id="sueldo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="$2999" required="" value="{{ $employee['sueldo'] }}">
                </div>
                <div>
                    <label for="codigoAcceso"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">codigoAcceso</label>
                    <input type="number" name="codigoAcceso" id="codigoAcceso"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="1234" required="" value="{{ $employee['codigoAcceso'] }}">

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input name="status" id="status" type="checkbox" value="1" class="sr-only peer"
                            @if ($employee['status'] == '1') checked @endif>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Estado
                        </span>
                    </label>
                </div>

                <x-modal-confirmation>
                    <x-slot name="id">
                        {{ $employee['id'] }}
                    </x-slot>

                    <x-slot name="button">
                        Editar Empleado
                    </x-slot>
    
                    <x-slot name="message_confirmation_modal">
                        ¿Confirma que desea actualizar los datos del empleado {{ $employee['nombre'] }}?
                    </x-slot>
                </x-modal-confirmation>
            </x-modal-edit>
        @endforeach
    </x-siderbar>
</x-app-layout>
