@if($issue)
@props(['issue', 'disableStyles' => false])
@if (!$disableStyles)
    <span class="px-3 py-1 rounded-full flex-row justify-center items-center gap-2 text-sm"
        style="color: {{ $issue->text_color }}; background-color: {{$issue->bg_color}};"
    >
    @endif
        {{ $issue->title }}
    </span>
    
@endif