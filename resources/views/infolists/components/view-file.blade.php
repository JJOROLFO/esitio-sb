{{-- <x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry"
            class="grid grid-cols-[--cols-default] fi-in-componet-ctn gap-6"> --}}
        
            {{-- @foreach ($getRecord()->file as $status )
                <div class="mb-4">
                    <div class="">
                        <span class="font-bold">{{$status->file}}</span>, <span x-data="{}" x-tooltip="{
                            content: '{{ $status->created_at}}',
                            
                        }">{{ $status->created_at->diffForHumans() }}</span>
                    </div>
                <div class="">
                    {{ $status->status->getLabel() }}
                </div>
                </div>
                
            @endforeach --}}

    <div>
        {{ $getState() }}
        @php
        $url = Illuminate\Support\Facades\Storage::url('chismis.pdf');
    @endphp
        <div class="embed-cover2"></div>
        <iframe ?wmode="transparent" class="min-w-full min-h-full frame" type="application/pdf"
            src="{{ $url }}#toolbar=1&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px"></iframe>
    </div>
    </div>
    <div>
        {{ $getRecord()->file }}
        
    {{-- <embed src="{{ $contents = Storage::get ('chismis.pdf') }}" type="application/pdf" width="100%" height="600px"> --}}
    
{{-- </x-dynamic-component> --}}

{{-- <div>
    @php
    $data = $this->getData();

    echo $data;
@endphp
</div> --}}

{{-- <x-filament::page>
    <h1>hello</h1>
</x-filament::page> --}}
{{-- <x-filament::link :href="route('ordinances.file')">
    New user
</x-filament::link> --}}