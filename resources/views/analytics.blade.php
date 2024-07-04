<x-layout>

    <x-slot:title>Analytics</x-slot:title>
    <div class="relative h-320 w-320">
        <div class="w-full absolute inset-0 -top-12 flex flex-col justify-start items-start gap-5" style="margin-left: 100px;padding: 20px;">
            <div class="w-full flex md:flex-row flex-col justify-between items-start gap-2">
                <div class="flex flex-col justify-center items-start gap-1">
                    <span class="lg:text-4xl md:text-2xl text-xl font-medium text-gray-700">
                        @lang('Analytics')
                    </span>
                    <span class="lg:text-lg md:text-sm text-xs font-light text-gray-500">
                        @lang('Below is the dashboard containing all analytics related to tickets configured in :app', [
                            'app' => config('app.name')
                        ])
                    </span>
                </div>
            </div>

            <div style="display: flex; flex-direction: row;" x-data="{ activeTab: 'content1' }">
                <div id="sidebar" style="left: 0px; top: 80px; margin: 0; padding: 0; width: 200px; background-color: #f1f1f1; position: fixed; height: 100%; overflow: auto;">
                    <a style="display: block; color: black; padding: 16px; text-decoration: none;">
                        <button @click="activeTab = 'content1'">Not assigned tickets</button>
                    </a>
                    <a style="display: block; color: black; padding: 16px; text-decoration: none;">
                        <button @click="activeTab = 'content2'">My assigned tickets</button>
                    </a>
                    <a style="display: block; color: black; padding: 16px; text-decoration: none;">
                        <button @click="activeTab = 'content3'">Tickets by statuses</button>
                    </a>
                    <a style="display: block; color: black; padding: 16px; text-decoration: none;">
                        <button @click="activeTab = 'content4'">Tickets assignments</button>
                    </a>
                    <a style="display: block; color: black; padding: 16px; text-decoration: none;">
                        <button @click="activeTab = 'content5'">Ticket Trends</button>
                    </a>
                </div>
                <div class="w-full flex flex-row flex-wrap">
                    <div class="lg:w-1 h-2/4 flex flex-col">
                        <div x-show="activeTab === 'content1'" id="content1">
                            <!-- Content for Not assigned tickets -->
                        </div>
                        <div x-show="activeTab === 'content2'" id="content2">
                            <!-- Content for My assigned tickets -->
                        </div>
                        <div x-show="activeTab === 'content3'" id="content3">
                            <!-- Content for Tickets by statuses -->
                        </div>
                        <div x-show="activeTab === 'content4'" id="content4">
                            <!-- Content for Tickets assignments -->
                            @livewire('analytics.ticket-assignments')
                        </div>
                        <div x-show="activeTab === 'content5'" id="content5">
                            <!-- Content for Ticket Trends -->
                            @livewire('analytics.ticket-trend')
                        </div>
                    </div>
                </div>
            </div>
            

            
            
        </div>
    </div>
</x-layout>
