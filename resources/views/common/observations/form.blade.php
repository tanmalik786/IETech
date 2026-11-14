@if(isset($shadow_form) && ! empty($shadow_form))
<form action="{{route('admin.shadow-forms.update', ['shadow_form' => $shadow_form->id])}}" method="POST">
@else
<form action="{{route('admin.shadow-forms.store')}}" method="POST">
@endif
    <div class="modal-body">
        @csrf
        @include('admin.observations.partials.shadow-form-fields')
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" type="button">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{isset($shadow_form) ? 'Update' : 'Save'}}
        </button>
    </div>
</form>