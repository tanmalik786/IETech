<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Observation Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            @if($observation_type->name == 'expert')
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Name of Observer:</p>
                            <p class="text-dark m-0">{{$observation->teacher_observed}}</p>
                        </li>
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Observee:</p>
                            <p class="text-dark m-0">{{$observation->year_group}}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Date:</p>
                            <p class="text-dark m-0">{{\Carbon\Carbon::parse($observation->date)->format('d F Y')}}</p>
                        </li>
                    </ul>
                </div>
            @elseif( $observation_type->name == 'general' )
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Trainee teacher observed:</p>
                            <p class="text-dark m-0">{{$observation->teacher_observed}}</p>
                        </li>
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">PSET course and year:</p>
                            <p class="text-dark m-0">{{$observation->year_group}}</p>
                        </li>
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Observed course/ level:</p>
                            <p class="text-dark m-0">{{$observation->course_title}}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Date:</p>
                            <p class="text-dark m-0">{{\Carbon\Carbon::parse($observation->date)->format('d F Y')}}</p>
                        </li>
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Number of Learners:</p>
                            <p class="text-dark m-0">{{$observation->number_of_students}}</p>
                        </li>
                        <li class="mb-3 d-flex justify-content-between align-items-center">
                            <p class="m-0">Organization:</p>
                            <p class="text-dark m-0">{{$observation->organization}}</p>
                        </li>
                    </ul>
                </div>
            @else

            @endif
        </div>
    </div>
</div>