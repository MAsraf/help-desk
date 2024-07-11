<div x-show="activeTab === 'content1'" id="content1" x-cloak style="flex: 1; height: 100%; overflow: auto;" style="display: {{ $notAssignedTickets->count() ? 'block' : 'none' }};">
    <div class="w-full p-5 ">
        <div class="w-full flex flex-col gap-5 p-5 rounded-lg border border-gray-100 shadow-lg bg-white">
            <span class="text-lg text-gray-500 font-medium">@lang('Not assigned tickets')</span>
            <div class="w-full overflow-x-auto relative sm:rounded-lg">
                <table id="notAssignedTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <caption class="hidden">@lang('Not assigned tickets')</caption>
                    <thead class="text-xs text-gray-700 uppercase
                        bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    @lang('Title')
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    @lang('Type')
                                </th>
                            </tr>
                    </thead>
                        @if($notAssignedTickets->count())
                        @foreach($notAssignedTickets as $ticket)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700
                            hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-4 px-6">
                                <a href="{{
                                                route(
                                                    'tickets.details',
                                                    [
                                                        'ticket' => $ticket,
                                                        'slug' => Str::slug($ticket->title)
                                                        ]
                                                    )
                                         }}" class="text-gray-500 text-sm hover:underline hover:text-primary-500">
                                    {{ $ticket->title }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                            {{ $ticket->issue }}
                            <!-- </td>
                            <td class="py-4 px-6">
                                <x-priority-span :priority="$ticket->priority" />
                            </td> -->
                            
                        </tr>
                        @endforeach
                        @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700
                        hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="4" class="py-4 px-6 text-center dark:text-white">
                                @lang('All tickets are assigned!')
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
