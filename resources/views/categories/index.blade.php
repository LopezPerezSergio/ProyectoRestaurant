<x-app-layout>
    <x-siderbar>
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 rounded-lg">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg overflow-hidden">

                    <x-slot name="title">
                        Modulo de Categorías
                    </x-slot>

                    @if (session('alert-category'))
                        <x-slot name="alert">
                            <x-alert>{{ session('alert-category') }}</x-alert>
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
                                        placeholder="Buscar mesa" required="">
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
                                Agregar Categoría
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <div class="uppercase">
                                <div class="p-4 grid grid-cols-2 gap-4 mb-4 md:grid-cols-4">
                                    @foreach ($categories as $category)
                                        <div class="max-w-sm rounded-lg shadow bg-yellow-300">
                                            <div class="w-full max-w-sm p-2">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h5 class=" text-xl font-bold tracking-tight text-white">
                                                        {{ $category['nombre'] }}
                                                    </h5>
                                                    <button id="{{ $category['id'] }}-dropdown-button"
                                                        data-dropdown-toggle="{{ $category['id'] }}-dropdown"
                                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-white hover:text-gray-800 rounded-lg focus:outline-none"
                                                        type="button">
                                                        <svg class="w-8 h-6" fill="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                                d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <button
                                                class="block max-w-sm p-2 h-56 bg-yellow-300 hover:bg-yellow-200 border border-gray-200 rounded-lg shadow dark:border-gray-700"
                                                type="button"
                                                data-drawer-target="drawer-right-products-{{ $category['id'] }}"
                                                data-drawer-show="drawer-right-products-{{ $category['id'] }}"
                                                data-drawer-placement="right"
                                                aria-controls="drawer-right-products-{{ $category['id'] }}">
                                                <h5 class="text-xl font-bold tracking-tight text-white">
                                                    Presiona aqui para visualizar la lista de {{ $category['nombre'] }}
                                                </h5>
                                                <figure
                                                    class="mt-2 relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                                                    <img class="rounded-lg h-28 w-28 mx-auto"
                                                        src="https://create.vista.com/s3-static/create/uploads/2022/09/cool-menu-examples.webp"
                                                        alt="category">
                                                </figure>
                                            </button>
                                        </div>


                                        <div id="{{ $category['id'] }}-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="{{ $category['id'] }}-dropdown-button">
                                                <li>
                                                    {{-- boton de modal edit --}}
                                                    <button id="edit{{ $category['id'] }}ModalButton"
                                                        data-modal-toggle="edit{{ $category['id'] }}Modal"
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- modal create -->
        <div id="createModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Nueva Categoría
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
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf

                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div>
                                <label for="nombre"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                <input type="text" name="nombre" id="nombre"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Nombre" required="">
                            </div>
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Agregar Categoría
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($categories as $category)
            <!-- Lista de productos de cada categoria -->
            <div id="drawer-right-products-{{ $category['id'] }}"
                class="w-full max-w-md fixed top-0 right-0 z-40 h-screen pt-20 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-right-products-{{ $category['id'] }}-label">

                <div class="h-full p-4 overflow-y-auto bg-yellow-100 dark:bg-gray-800">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Productos de
                            {{ $category['nombre'] }}</h5>
                        <a href="{{ route('product.index') }}"
                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Ver todo
                        </a>
                    </div>

                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @if ($category['productos'] === [])
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <h5 class="text-m font-bold leading-none text-gray-900 dark:text-white">
                                                Esta categoria aun no tiene Productos
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                            @else
                                @foreach ($category['productos'] as $product)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full"
                                                    src="{{ Storage::url($product['url_img']) }}" alt="image">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    {{ $product['nombre'] }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    @if ($product['tamanio'] == 'S')
                                                        Chico
                                                    @endif
                                                    @if ($product['tamanio'] == 'M')
                                                        Mediano
                                                    @endif
                                                    @if ($product['tamanio'] == 'L')
                                                        Grande
                                                    @endif
                                                    @if ($product['tamanio'] == 'XL')
                                                        Familiar
                                                    @endif
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                ${{ $product['precio'] }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
            
            <x-modal-edit>
                <x-slot name="modal">
                    {{ $category['id'] }}
                </x-slot>
                <x-slot name="url">
                    {{ route('category.update', $category['id']) }}
                </x-slot>
                <x-slot name="title">
                    Editar Categoría
                </x-slot>
                <div>
                    <label for="nombre"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" name="nombre" id="nombre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Nombre" required="" value="{{ $category['nombre'] }}">
                </div>
                <div></div>
                {{-- componente que tiene el modal de confirmacion para la edicion de datos (aqui esta el boton de tipo SUPMIT) --}}
                <x-modal-confirmation>
                    <x-slot name="id">
                        {{ $category['id'] }}
                    </x-slot>

                    <x-slot name="button">
                        Editar Categoría
                    </x-slot>

                    <x-slot name="message_confirmation_modal">
                        ¿Confirma que desea actualizar los datos de {{ $category['nombre'] }}?
                    </x-slot>
                </x-modal-confirmation>
            </x-modal-edit>
        @endforeach
    </x-siderbar>
</x-app-layout>
