<div>

    <div id="crud-table-body" class="w-full rounded-lg bg-white shadow mb-8">
        <div id="crud-table-header" class="p-2 border-b border-gray-200 flex flex-col md:flex-row justify-between flex-wrap">
            <div id="crud-search-box" class="w-full md:w-auto -mx-2 mb-2 md:mb-0 flex"><div class="px-2 flex items-center justify-center">
                    <button class="rounded-full hover:border-blue-400 hover:text-white hover:bg-blue-400 text-sm h-10 flex items-center justify-center cursor-pointer bg-white px-3 outline-none text-gray-800 border border-gray-400" @click="showModal = true">
                        <i class="las la-plus"></i>
                    </button>
                </div>
                <div class="px-2"><div class="rounded-full p-1 bg-gray-200 flex">
                        <input type="text" class="w-36 md:w-auto bg-transparent outline-none px-2"
                            placeholder="Search..." wire:model="search">
                        <button class="rounded-full w-8 h-8 bg-white outline-none hover:bg-blue-400 hover:text-white">
                            <i class="las la-search"></i>
                        </button>
                        <!---->
                    </div>
                </div>
                <div class="px-2 flex">
                    <button class="rounded-full hover:border-blue-400 hover:text-white hover:bg-blue-400 text-sm h-10 bg-white px-3 outline-none text-gray-800 border border-gray-400"
                            wire:click="refreshTable">
                        {{-- <div wire:loading wire:target="refreshTable">
                            <i class="las la-sync"></i>
                        </div>--}}
                        <i class="las la-sync"></i>
                    </button>

                </div>
            </div>
            <div id="crud-buttons" class="-mx-1 flex flex-wrap w-full md:w-auto">
                @if(count($selectedRoles) > 0)
                    <div class="px-1 flex">
                        <button class="flex justify-center items-center rounded-full text-sm h-10 px-3 hover:border-blue-400 hover:text-white hover:bg-blue-400 outline-none border-gray-400 border text-gray-700">
                            <i class="lar la-check-square"></i> {{ count($selectedRoles) }} entries selected
                        </button>
                    </div>
                @endif
                <div class="px-1 flex">
                    <button class="flex justify-center bg-blue-400 items-center rounded-full text-sm h-10 px-3 bg-teal-400 outline-none text-white font-semibold"
                    wire:click="export">
                        <i class="las la-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="overflow-x-auto flex-auto">
                <table class="table w-full">
                    <thead>
                    <tr class="text-gray-700 border-b border-gray-200">
                        <th class="text-center px-2 border-gray-200 bg-gray-100 border w-16 py-2">
                            <div class="flex items-center justify-center cursor-pointer">
                                <div class="w-6 h-6 flex bg-white border-2 items-center justify-center cursor-pointer">
                                    <!---->
                                </div> <!---->
                                <!----></div>
                        </th>
                        <th class="cursor-pointer justify-betweenw-40 border bg-gray-100 text-left px-2 border-gray-200 py-2" style="min-width: auto;">
                            <div class="w-full flex justify-between items-center">
                                <span class="flex">@lang('roles.role_name')</span>
                                <span class="h-6 w-6 flex justify-center items-center">
                                    <!----> <!---->
                                </span>
                            </div>
                        </th>

                        <th class="cursor-pointer justify-betweenw-40 border bg-gray-100 text-left px-2 border-gray-200 py-2" style="min-width: auto;">
                            <div class="w-full flex justify-between items-center">
                                <span class="flex">@lang('common.created_at')</span>
                                <span class="h-6 w-6 flex justify-center items-center">
                                    <!----> <!---->
                                </span>
                            </div>
                        </th>
                        <th colspan="2" class="text-center px-2 py-2 w-16 border border-gray-200 bg-gray-100">
                            @lang('common.options')
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                    <tr class="border-gray-200 border text-sm">
                        <td class="text-gray-700 font-sans border-gray-200 p-2">
                            <div class="flex items-center justify-center cursor-pointer">
                                <input type="checkbox" class="w-6 h-6 flex bg-white border-2 items-center justify-center cursor-pointer"
                                        value="{{$role->id}}" wire:model="selectedRoles">
                            </div>
                        </td>
                        <td class="text-gray-700 font-sans border-gray-200 p-2">
                            {{ $role->name }}
                        </td>

                        <td class="text-gray-700 font-sans border-gray-200 p-2">
                            {{$role->created_at}}
                        </td>
                        <td colspan="2" class="text-center">
                            <button class="rounded-full hover:border-yellow-800 hover:text-white hover:bg-yellow-500 text-sm h-10 bg-white px-3 outline-none text-gray-800 border border-gray-400" @click="editRoleModal = true" wire:click="edit({{$role->id}})">
                                <i class="las la-edit"></i>
                            </button>
                            @if($confirming === $role->id)
                                <button class="rounded-full hover:border-red-800 hover:text-white hover:bg-red-400 text-sm h-10 bg-white px-3 outline-none text-gray-800 border border-gray-400"
                                        wire:click="deleteSingleRole({{$role->id}})">
                                    @lang('common.are_you_sure')
                                </button>
                            @else
                                <button class="rounded-full hover:border-red-800 hover:text-white hover:bg-red-400 text-sm h-10 bg-white px-3 outline-none text-gray-800 border border-gray-400"
                                        wire:click="confirmSingRoleDelete({{$role->id}})">
                                    <i class="las la-trash"></i>
                                </button>
                            @endif
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-2 flex flex-col md:flex-row justify-between">
            <div id="grouped-actions" class="mb-2 md:mb-0 flex justify-between rounded-full bg-gray-200 p-1">
                <select name="action" id="grouped-actions" class="text-gray-800 outline-none bg-transparent" wire:model="action">
                    <option selected="selected" value="0">@lang('common.select_action')</option>
                    <option value="1">@lang('common.delete_selected_itens')</option>
                </select>
                <button class="h-8 w-8 outline-none hover:bg-blue-400 hover:text-white rounded-full bg-white flex items-center justify-center"
                        wire:click="confirmDeleteModal">
                    Go
                </button>
            </div>
            <div class="flex">
                <div class="items-center flex text-gray-600 mx-4"></div>
                <div id="pagination" class="flex -mx-1">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
@include('roles.create')
@include('roles.edit')
</div>
