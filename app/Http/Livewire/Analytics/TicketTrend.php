<?php

namespace App\Http\Livewire\Analytics;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Ticket;

class TicketTrend extends Component
{
    public $startDate;
    public $endDate;
    public $ticketCreationData;
    public $pendingTicketData;
    public $closedTicketData;
    public $labels;

    public function mount()
    {
        // Set default dates
        $this->startDate = Carbon::now()->startOfYear()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->fetchData();
    }

    public function updated($property)
    {
        if (in_array($property, ['startDate', 'endDate'])) {
            $this->fetchData();
        }
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
                $createdDate = Carbon::parse($ticket->created_at);
                $closedDate = $ticket->closed_at ? Carbon::parse($ticket->closed_at) : null;
                return $createdDate->lte($dateString) && (!$closedDate || $closedDate->gt($dateString));            })->count();

            $this->closedTicketData[] = $tickets->filter(function($ticket) use ($dateString) {
                return $ticket->closed_at && Carbon::parse($ticket->closed_at)->format('Y-m-d') == $dateString;
            })->count();

        }

        // Ensure arrays are sorted by date
        ksort($this->ticketCreationData);
        ksort($this->pendingTicketData);
        ksort($this->closedTicketData);
        $this->ticketCreationData = array_values($this->ticketCreationData);
        $this->pendingTicketData = array_values($this->pendingTicketData);
        $this->closedTicketData = array_values($this->closedTicketData);
    }

    public function render()
    {
        return view('livewire.analytics.ticket-trend', [
            'ticketCreationData' => $this->ticketCreationData,
            'pendingTicketData' => $this->pendingTicketData,
            'closedTicketData' => $this->closedTicketData,
            'labels' => $this->labels,
        ]);
    }
}
