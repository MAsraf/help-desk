<div>
<div class="w-full p-5">
            <div class="w-full flex flex-col justify-center items-center gap-5 p-5
                rounded-lg border border-gray-100 shadow-lg bg-white">
                <span class="text-lg text-gray-500 font-medium w-full text-left">
                    @lang('Tickets by statuses')
                </span>
                {{-- Chart --}}
                <div class="overflow-x-auto relative sm:rounded-lg w-full">
                    <canvas id="ticketsByStatuses" style="height: 97px;"></canvas>
                </div>
                {{-- Table for chart --}}
                <div class="w-full overflow-x-auto relative sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <caption class="hidden">@lang('Tickets by statuses')</caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    @lang('Status')
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    @lang('Tickets')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($ticketsByStatuses))
                            @foreach($ticketsByStatuses as $status => $count)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700
                                hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-4 px-6">
                                    {{ $status }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $count }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700
                            hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td colspan="4" class="py-4 px-6 text-center dark:text-white">
                                    @lang('No tickets configured!')
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <script>
        document.addEventListener('livewire:load', function () {
        let statusChart = null;

        function renderChartStatus(ticketsByStatuses) {
            const ctxStatus = document.getElementById('ticketsByStatuses').getContext('2d');
            if (statusChart) {
                statusChart.destroy();
            }

            const labels = Object.keys(ticketsByStatuses);
            const data = Object.values(ticketsByStatuses);

            statusChart = new Chart(ctxStatus, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '@lang('Tickets assignments')',
                        data: data,
                        backgroundColor: [
                            'rgba(240, 82, 82, 0.8)',
                            'rgba(56, 187, 132, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        offset: 10
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            position: 'right',
                            labels: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Initial rendering
        renderChartStatus(@json($ticketsByStatuses));

        // Re-rendering when Livewire updates
        Livewire.hook('message.processed', (message, component) => {
            if (component.fingerprint.name === 'analytics.ticket-statuses') {
                const ticketsByStatuses = component.get('ticketsByStatuses') || [];
                const labels = Object.keys(ticketsByStatuses);
                const data = Object.values(ticketsByStatuses);

                statusChart.data.labels = labels;
                statusChart.data.datasets[0].data = data;
                statusChart.update();
            }
        });
    });
    </script>
</div>