<?php

namespace App\Http\Livewire\Analytics;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Ticket;

class TicketTrend extends Component
{
    public $startDate;
    public $endDate;
    public $selectedMonth;
    public $ticketCreationData = [];
    public $pendingTicketData = [];
    public $closedTicketData = [];
    public $labels = [];
    public $totalCreated = 0;
    public $totalClosed = 0;
    public $totalPending = 0;

    public function mount()
    {
        $this->selectedMonth = Carbon::now()->format('Y-m');
        $this->updateDates();
        $this->fetchData();
    }

    public function updatedSelectedMonth(): void
    {
        $this->updateDates();
        $this->fetchData();
    }

    protected function updateDates()
    {
        $month = Carbon::createFromFormat('Y-m', $this->selectedMonth)->month;
        $this->startDate = Carbon::now()->startOfMonth()->month($month)->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->month($month)->format('Y-m-d');
    }

    public function fetchData()
    {
        $tickets = Ticket::select('created_at', 'inprogress_at', 'closed_at')
                         ->whereBetween('created_at', [$this->startDate, $this->endDate])
                         ->get();

        $this->ticketCreationData = [];
        $this->pendingTicketData = [];
        $this->closedTicketData = [];
        $this->labels = [];

        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $this->labels[] = $dateString;

            $this->ticketCreationData[] = $tickets->filter(function($ticket) use ($dateString) {
                return Carbon::parse($ticket->created_at)->format('Y-m-d') == $dateString;
            })->count();

            $this->pendingTicketData[] = $tickets->filter(function($ticket) use ($dateString) {
                $createdDate = Carbon::parse($ticket->created_at)->format('Y-m-d');
                $closedDate = $ticket->closed_at ? Carbon::parse($ticket->closed_at)->addDay()->format('Y-m-d') : null;
                return $createdDate <= $dateString && (!$closedDate || $dateString < $closedDate);
            })->count();

            $this->closedTicketData[] = $tickets->filter(function($ticket) use ($dateString) {
                return $ticket->closed_at && Carbon::parse($ticket->closed_at)->format('Y-m-d') == $dateString;
            })->count();
        }

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totalCreated = array_sum($this->ticketCreationData);
        $this->totalClosed = array_sum($this->closedTicketData);
        $this->totalPending = $this->totalCreated - $this->totalClosed;
    }

    public function render()
    {
        return view('livewire.analytics.ticket-trend', [
            'ticketCreationData' => $this->ticketCreationData,
            'pendingTicketData' => $this->pendingTicketData,
            'closedTicketData' => $this->closedTicketData,
            'labels' => $this->labels,
            'totalCreated' => $this->totalCreated,
            'totalClosed' => $this->totalClosed,
            'totalPending' => $this->totalPending,
            'selectedMonth' => $this->selectedMonth,
        ]);
    }
}
