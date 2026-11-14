<div class="modal fade" id="editObservation">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    @if($observation_type->name == 'shadow' )
                        Shadow Form
                    @elseif($observation_type->name == 'general')
                        Observation
                    @else
                        {{ucfirst($observation_type->name) . ' Observation'}}
                    @endif
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
</div>