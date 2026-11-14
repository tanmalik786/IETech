@switch($section->section_type_id)
    @case('1')
        {!! $section->sectionable->content !!}
    @break
    @case('2')
    <img src="{{asset('storage/pages/featured-images/'. $section->sectionable->name)}}" alt="" class="w-100">
    @break
    @case('5')
    <object style="min-width:100%;min-height:800px;" data="{{asset('storage/pages/pdf/'. $section->sectionable->name)}}" type="application/pdf">
        <iframe style="min-width:100%;min-height:800px;" src="https://docs.google.com/viewer?url={{asset('storage/pages/pdf/'. $section->sectionable->name)}}&embedded=true"></iframe>
    </object>
    @break
@endswitch