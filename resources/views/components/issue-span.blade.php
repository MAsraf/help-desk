@if($issue)
    <span class="px-3 py-1 rounded-full flex flex-row justify-center items-center gap-2 text-sm"
        style="color: {{ $issue->text_color }}; background-color: {{$issue->bg_color}};"
    >
        {{ $issue->title }}
    </span>
@endif