<?php

namespace App\Http\Livewire\Analytics;

use App\Models\Ticket;
use App\Models\TicketStatus;
use Livewire\Component;

class TicketStatuses extends Component
{
    public $ticketsByStatuses = [];

    public function mount(): void
    {
        $this->loadTicketsByStatuses();
    }

    public function render()
    {
        return view('livewire.analytics.ticket-statuses', [
            'ticketsByStatuses' => $this->ticketsByStatuses
        ]);
    }

    /**
     * Load tickets by statuses
     *
     * @return void
     */
    private function loadTicketsByStatuses(): void
    {
        $query = Ticket::query();
        if (auth()->user()->can('View own tickets') && !auth()->user()->can('View all tickets')) {
            $query->where(function ($query) {
                $query->where('owner_id', auth()->user()->id)
                    ->orWhere('responsible_id', auth()->user()->id);
            });
        }
        $tickets = $query->get()->groupBy('status');
        $this->ticketsByStatuses = [];
        $statuses = TicketStatus::all();
        foreach ($statuses as $status) {
            $this->ticketsByStatuses[$status->title] = $tickets->get($status->slug, collect())->count();
        }
    }
}
