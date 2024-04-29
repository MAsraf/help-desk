<div>
<div class="bg-[#eff5ff] rounded overflow-hidden ">
    <div class="flex whitespace-nowrap text-base font-semibold px-0 py-2 animate-banner-slide-left hover:pause">
        <div class="flex">
        @foreach ($notices as $notice) 
        <div wire:key="{{ $notice->id }}"> 
            @if ($notice->status==1)
            <div class="px-[30px] py-0"><i class="fa-solid fa-circle"></i>  {{$notice->content}}</div>
            @endif
        </div>
            
        @endforeach
            <!-- Add More Items Here -->
        </div>
    </div>
</div>

<div>
    
