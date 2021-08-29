<div id="roleModal" class=class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="createUserModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': createUserModal }" wire:ignore.self>

    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border shadow-xl" x-show="createUserModal" @click.away="createUserModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="flex flex-row justify-between p-6 bg-white border-b rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800">@lang('users.add_new')</p>
            <svg
                @click="createUserModal = false"
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
                <form wire:submit.prevent="createUser" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                        <div class="flex justify-between items-center">
                            <label for="title" class="font-bold my-2 text-gray-700">@lang('users.user_name')</label>
                        </div>
                        <div class="flex border-2 rounded overflow-hidden border-blue-500">
                            <input name="ind" type="text" class="flex-auto text-gray-700 outline-none h-10 px-2" wire:model="name">
                            <button type="submit" class="outline-none px-4 h-10 text-white border-l border-gray-400 bg-blue-500">
                                @lang('common.save')
                            </button>
                        </div>
                    @error('name')
                        <p class="text-xs text-red-600 py-1">
                            {{$message}}
                        </p>
                    @enderror
                    <div class="border border-gray-400 p-4 bg-white mt-5">
                        <div class="-mx-4 flex flex-wrap">
                            <div class="px-4 w-full md:w-1/2 lg:w-1/3">
                                <div class="flex flex-auto">
                                    <div class="flex flex-col mb-2 flex-auto">
                                        <label for="email" class="block leading-5 font-medium font-bold text-gray-700">Email</label>
                                        <div class="mt-1 relative border-2 rounded-md focus:shadow-sm border-gray-200">
                                            <input id="email" type="text" class="form-input block w-full sm:text-sm sm:leading-5 h-10 bg-transparent px-4" wire:model="email">
                                        </div>
                                        @error('email')
                                            <p class="text-xs text-red-600">{{$message}}</p>
                                        @enderror
                                        {{-- <p class="text-xs text-red-400">
                                            This field must contain a valid email address.
                                        </p>
                                        --}}
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 w-full md:w-1/2 lg:w-1/3">
                                <div class="flex flex-auto">
                                    <div class="flex flex-col mb-2 flex-auto">
                                        <label for="password" class="block leading-5 font-medium font-bold text-gray-700">Password</label>
                                        <div class="mt-1 relative border-2 rounded-md focus:shadow-sm border-gray-200">
                                            <input id="password" type="password" class="form-input block w-full sm:text-sm sm:leading-5 h-10 bg-transparent px-4" wire:model="password">
                                        </div>
                                        @error('password')
                                            <p class="text-xs text-red-600">
                                                <span>{{$message}}</span>
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 w-full md:w-1/2 lg:w-1/3">
                                <div class="flex flex-auto">
                                    <div class="flex flex-col mb-2 flex-auto">
                                        <label for="password_confirm" class="block leading-5 font-medium font-bold text-gray-700">Confirm Password</label>
                                        <div class="mt-1 relative border-2 rounded-md focus:shadow-sm border-gray-200">
                                            <input id="password_confirm" type="password" class="form-input block w-full sm:text-sm sm:leading-5 h-10 bg-transparent px-4" wire:model="password_confirmation">
                                        </div>
                                        @error('confirm_password')
                                        <p class="text-xs text-gray-500">
                                            <span>{{$message}}</span>
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 w-full md:w-1/2 lg:w-1/3">
                            <div class="flex flex-auto">

                                <div class="flex flex-col flex-auto">
                                    <label for="role_id" class="block leading-5 font-medium font-bold text-gray-700">Active</label>
                                    <div class="border-2 mt-1 relative rounded-md shadow-sm mb-2 border-gray-200">
                                        <select name="active" class="text-gray-700 form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 h-10 bg-transparent px-4" wire:model="active">
                                            <option class="py-2" value="">---</option>
                                            <option class="py-2" value="0">No</option>
                                            <option class="py-2" value="1">Yes</option>
                                        </select>
                                    </div>
                                    @error('active')
                                        <p class="text-xs text-red-600">
                                            <span>{{$message}}</span>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div class="px-4 w-full md:w-1/2 lg:w-1/3">
                                <div class="flex flex-auto">
                                    <div class="flex flex-col flex-auto">
                                        <label for="role_id" class="block leading-5 font-medium font-bold text-gray-700">Role</label>
                                        <div class="border-2 mt-1 relative rounded-md shadow-sm mb-2 border-gray-200">
                                            <select name="roles_id[]" multiple class="text-gray-700 form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 h-10 bg-transparent px-4" wire:model="roles_id">
                                                <option class="py-2" value="">---</option>
                                                @foreach($roles as $role)
                                                    <option class="py-2" value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        {{-- @include('users.multi-select-roles')  --}}
                                        <button wire:click="chad">click!</button>
                                        @error('role_id')
                                        <p class="text-xs text-red-600">
                                            <span>{{$message}}</span>
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>

            </div>

            <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5">
            </div>
        </div>
    </div>
</div>
