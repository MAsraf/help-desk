<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use App\Models\TicketStatus;
use Livewire\Component;

class Analytics extends Component
{
    
    
    

    public $startDate;
    public $endDate;

    public function mount(): void
    {
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->endDate = now()->endOfMonth()->toDateString();

        $this->loadAssignedTickets();
        $this->loadNotAssignedTickets();
    }

    public function render()
    {
        return view('livewire.analytics');
    }

    

    

    
}
