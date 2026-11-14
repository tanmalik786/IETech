<tr>
    <td>{{$observations->firstItem() + $loop->index}}</td>
    @if(auth()->user()->hasAnyRole('Teaching Student') == false)
        <td>{{$observation->observed->full_name ?? '-'}}</td>
    @endif
    <td>{{$observation->observer->full_name ?? '-'}} - <span class="text-strong">{{$observation->observer->roles[0]->name ?? ''}}</span></td>
    <td>{{$observation->course_year}}</td>
    <td>{{$observation->observed_course}}</td>
    <td>{{$observation->strength}}</td>
    <td>{{! empty($observation->date) ? $observation->date->format('d/m/Y') : ''}}</td>
    <td>
        <a href="{{route('observations.show', ['observation' => $observation->id])}}"><i class="fas fa-eye"></i></a>
        @if( auth()->user()->hasAnyRole(['Mentor', 'Link Tutor']))
            <a href="{{route('observations.edit', ['observation' => $observation->id])}}" class="text-primary"><i class="fas fa-pencil-alt mr-2"></i></a>
            <a href="#"
               class="text-danger"
               data-action="{{route('observations.destroy', ['observation' => $observation->id])}}"
               data-target="#destroyObservationModal"
               data-toggle="modal">
                <i class="fas fa-trash-alt"></i>
            </a>
        @endif
    </td>
</tr>