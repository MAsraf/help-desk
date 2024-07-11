<?php

namespace App\Http\Livewire\TicketDetails;

use App\Jobs\TicketUpdatedJob;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketType;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class Type extends Component implements HasForms
{
    use InteractsWithForms;

    public Ticket $ticket;
    public bool $updating = false;

    public function mount(): void
    {
        $issue = $this->ticket->issue;
        $subcategory = $this->ticket->subcategory;
        if($issue || $subcategory){
            $type = TicketType::where('slug',TicketCategory::where('slug',$issue ?? $subcategory)->pluck('type')->first())->get();
        }
        
        
        
        $this->form->fill([
            'type' => $type
        ]);
    }

    public function render()
    {
        return view('livewire.ticket-details.type');
    }

    /**
     * Form schema definition
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [
            Select::make('type')
                ->label(__('Type'))
                ->disableLabel()
                ->placeholder(__('Type'))
                ->required()
                ->searchable()
                ->options(function($state){
                    $types = types_list();
                    unset($types[$state]);
                    return $types;
                }),
        ];
    }

    /**
     * Enable updating
     *
     * @return void
     */
    public function update(): void
    {
        $this->updating = true;
    }

    /**
     * Save main function
     *
     * @return void
     */
    public function save(): void
    {
        $data = $this->form->getState();
        $before = $this->ticket->type ?? '-';
        $this->ticket->type = $data['type'];        //remove title / name
        $this->ticket->save();
        Notification::make()
            ->success()
            ->title(__('Type updated'))
            ->body(__('The ticket type has been successfully updated'))
            ->send();
        $this->form->fill([
            'type' => $this->ticket->type
        ]);
        $this->updating = false;
        $this->emit('ticketSaved');
        TicketUpdatedJob::dispatch(
            $this->ticket,
            __('Type'),
            $before,
            ($this->ticket->type ?? '-'),
            auth()->user()
        );
    }
}
