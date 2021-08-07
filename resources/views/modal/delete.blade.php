<div id="roleModal" class=class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }" wire:ignore.self>

    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border shadow-xl" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="flex flex-row justify-between p-6 bg-white border-b rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800">@lang('roles.add_new')</p>
            <svg
                @click="showModal = false"
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </div>
        <div class="flex flex-col px-6 py-5 bg-gray-50">
            <div class="flex flex-col">
                <div class="flex justify-between items-center">
                    <label for="title" class="font-bold my-2 text-gray-700">@lang('roles.role_name')</label>
                </div>
                <form wire:submit.prevent="submitRole" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="flex border-2 rounded overflow-hidden border-blue-500">
                        <input name="ind" type="text" class="flex-auto text-gray-700 outline-none h-10 px-2" wire:model="name">
                        <button type="submit" class="outline-none px-4 h-10 text-white border-l border-gray-400 bg-blue-500">
                            @lang('roles.save')
                        </button>
                    </div>
                </form>

                <p class="text-xs text-gray-600 py-1">Provide a name to the role.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5">
            </div>
        </div>
    </div>
</div>
