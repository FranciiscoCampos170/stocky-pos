<div>
    <div id="dashboard-content" class="px-4 flex flex-col">
        <div class="flex-auto flex flex-col">
            <div class="page-inner-header mb-4">
                <h3 class="text-3xl text-gray-800 font-bold">
                    @lang('roles.permission_manager')
                </h3>
                <p class="text-gray-600">
                    @lang('roles.manage_all_permissions_and_roles')
                </p>
            </div>
        </div>
        <div class="pb-4">
            <div id="permission-wrapper">
                <div class="rounded shadow bg-white flex">
                    <div id="permissions" class="w- bg-gray-800 flex-shrink-0">
                        <div class="py-4 px-2 border-b border-gray-700 text-gray-100">
                            Permissions
                        </div>
                        @foreach($permissions as $permission)
                        <div class="p-2 border-b border-gray-700 text-gray-100">
                            <a href="javascript:void(0)" title="create.users">
                                {{ $permission->name }}
                            </a>
                        </div>
                        @endforeach
                        </div>
                    <div class="flex flex-auto overflow-hidden">
                        <div class="overflow-y-auto">
                            <div class="border-b border-gray-200 text-gray-700 flex">
                                <div class="py-4 px-2 items-center justify-center flex role w-56 flex-shrink-0 border-r border-gray-200">
                                    <p class="mx-1">
                                        <span>User</span>
                                    </p>
                                    <span class="mx-1">
                                        <div class="flex items-center justify-center cursor-pointer">
                                            <div class="w-6 h-6 flex bg-white border-2 items-center justify-center cursor-pointer">
                                            </div>
                                            <span class="mx-2">
                                            </span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            @foreach($permissions as $permission)
                                <div class="permission flex border-b border-gray-200">
                                    <div class="w-56 flex-shrink-0 p-2 flex items-center justify-center border-r">
                                        <div class="flex items-center justify-center cursor-pointer">
                                            <div class="w-6 h-6 flex bg-white border-2 items-center justify-center cursor-pointer">
                                                <input type="checkbox" class="w-6 h-6 flex bg-white border-2 items-center justify-center cursor-pointer" value="">
                                            </div>
                                            <span class="mx-2"></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
