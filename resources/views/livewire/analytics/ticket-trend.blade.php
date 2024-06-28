<div>
    <div>
        <label for="start-date">Start Date:</label>
        <input type="date" id="start-date" wire:model.lazy="startDate">
        <label for="end-date">End Date:</label>
        <input type="date" id="end-date" wire:model.lazy="endDate">
    </div>

    <div>
        <input type="checkbox" id="toggle-creation" checked onchange="toggleDataset(0)">
        <label for="toggle-creation">Ticket Creation</label>

        <input type="checkbox" id="toggle-pending" checked onchange="toggleDataset(1)">
        <label for="toggle-pending">Pending Tickets</label>

        <input type="checkbox" id="toggle-closed" checked onchange="toggleDataset(2)">
        <label for="toggle-closed">Closed Tickets</label>
    </div>

    <canvas id="ticketChart" width="400" height="200"></canvas>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Ticket Creation</th>
                <th>Pending Tickets</th>
                <th>Closed Tickets</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $index => $label)
                <tr>
                    <td>{{ $label }}</td>
                    <td>{{ $ticketCreationData[$index] }}</td>
                    <td>{{ $pendingTicketData[$index] }}</td>
                    <td>{{ $closedTicketData[$index] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <canvas id="ticketChart" width="400" height="200"></canvas>

    <script>
        document.addEventListener('livewire:load', function () {
            let ticketChart = null;

            function renderChart(labels, ticketCreationData, pendingTicketData, closedTicketData) {
                const ctx = document.getElementById('ticketChart').getContext('2d');
                if (ticketChart) {
                    ticketChart.destroy();
                }
                ticketChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Ticket Creation',
                                data: ticketCreationData,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: false
                            },
                            {
                                label: 'Pending Tickets',
                                data: pendingTicketData,
                                borderColor: 'rgba(255, 159, 64, 1)',
                                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                fill: true
                            },
                            {
                                label: 'Closed Tickets',
                                data: closedTicketData,
                                hidden: true,
                                borderColor: 'rgba(153, 102, 255, 1)',
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                fill: false
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Ticket Trends Over Time'
                        },
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                },
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                max:5,
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Number of Tickets'
                                },
                                ticks: {
                                    stepSize: 1,
                                    callback: function(value) {
                                        if (Number.isInteger(value)) {
                                            return value;
                                        }
                                    }   
                                }
                            }
                        }
                    }
                });
            }

            function toggleDataset(index) {
                const chart = ticketChart;
                const meta = chart.getDatasetMeta(index);
                meta.hidden = meta.hidden === null ? !chart.data.datasets[index].hidden : null;
                chart.update();
            }

            // Initial rendering
            renderChart(@json($labels), @json($ticketCreationData), @json($pendingTicketData), @json($closedTicketData));

            // Re-rendering when Livewire updates
            Livewire.hook('message.processed', (message, component) => {
                renderChart(
                    component.get('labels').map(label => label),
                    component.get('ticketCreationData').map(data => data),
                    component.get('pendingTicketData').map(data => data),
                    component.get('closedTicketData').map(data => data)
                );
            });
        });
    </script>
</div>