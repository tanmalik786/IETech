<form action="" method="POST">
    @php
        $stages = [
            'initial' => 'midterm',
            'midterm' => 'exit'
        ];
    @endphp
    <input type="hidden" name="review_id" value="{{isset($review) && $clone == false ? $review->id : ''}}">
    @if( empty($review) || $clone === true )
    <input type="hidden" name="stage" value="{{! isset($review) || empty($review) ? 'initial' : $stages[$review->stage]}}">
    @endif
    @csrf
    @foreach($questions as $key => $question)
        <input type="hidden" name="activities[{{$key}}]" value="{{$question['label']}}">
        @php
            $currentReviewDetail = isset($review) ? $review->details()->where('activity', $question['label'])->where('step', $step)->orderBy('id','desc')->first() : false;
        @endphp
        @if( auth()->user()->hasRole('Teaching Student') )
            @if( $question['label'] != 'Examiner/Link tutor feedback [Comments]')
                <div id="accordion{{$key}}">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$key}}">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link text-dark collapsed text-left" style="font-weight: bold;" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne">
                                    {{$question['label']}}
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$key}}">
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <textarea name="responses[{{$key}}]" class="form-control" id="" cols="30" rows="6" style="min-height: 150px;">{!! $currentReviewDetail != false ? $currentReviewDetail->response : '' !!}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card-body">
                                    @if( isset($question['sub_section']) && ! empty($question['sub_section']) )
                                        @foreach($question['sub_section'] as $_key => $_question)
                                            <div class="form-row">
                                                <label for="" class="col-lg-6">{{$_question['label']}}</label>
                                                <input type="hidden" name="sub_activities[{{$key}}]" value="{{$_question['label']}}">
                                                @switch($_question['input_type'])
                                                    @case('text')
                                                    <div class="col-lg-3">
                                                        <input class="form-control" type="text" required name="sub_responses[{{$key}}]" value="" placeholder="{{$_question['placeholder']}}">
                                                    </div>
                                                    @break
                                                    @case('textarea')
                                                    <div class="col-lg-12">
                                                        <textarea name="sub_responses[{{$key}}]" class="form-control" id="" cols="30" rows="3">{!! $currentReviewDetail != false && $currentReviewDetail->subActivity != null ? $currentReviewDetail->subActivity()->pluck('response')->first() : '' !!}</textarea>
                                                    </div>
                                                    @break
                                                @endswitch
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            @if( $question['label'] == 'Examiner/Link tutor feedback [Comments]' )
                <div class="card mb-3" style="border-bottom: 5px solid #18a2b8">
                    <div class="card-body">
                        <div class="form-row py-2 mb-3">
                            <label for="" class="col-lg-12">{{$question['label']}}</label>
                            <input type="hidden" name="activities[{{$key}}]" value="{{$question['label']}}">
                            <div class="col-lg-12">
                                <textarea name="responses[{{$key}}]" class="form-control" id="" cols="30" rows="6" style="min-height: 150px;">{!! $currentReviewDetail != false ? $currentReviewDetail->response : '' !!}</textarea>
                            </div>
                        </div>
                        @if( isset($question['sub_section']) && ! empty($question['sub_section']) )
                            @foreach($question['sub_section'] as $_key => $_question)
                                <div class="form-row">
                                    <label for="" class="col-lg-6">{{$_question['label']}}</label>
                                    <input type="hidden" name="sub_activities[{{$key}}]" value="{{$_question['label']}}">
                                    @switch($_question['input_type'])
                                        @case('text')
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" required name="sub_responses[{{$key}}]" value="" placeholder="{{$_question['placeholder']}}">
                                        </div>
                                        @break
                                        @case('textarea')
                                        <div class="col-lg-12">
                                            <textarea name="sub_responses[{{$key}}]" class="form-control" id="" cols="30" rows="3">{!! $currentReviewDetail != false && $currentReviewDetail->subActivity != null ? $currentReviewDetail->subActivity()->pluck('response')->first() : '' !!}</textarea>
                                        </div>
                                        @break
                                    @endswitch
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @else
                <div class="card mb-3" style="border-bottom: 5px solid #18a2b8">
                    <div class="card-body">
                        <div class="py-2 mb-3">
                            <p class="mb-0"><strong>{{$question['label']}}</strong></p>
                            <p class="text-muted mb-0">
                                {!! $currentReviewDetail != false ? $currentReviewDetail->response : '' !!}
                            </p>
                        </div>
                        @if( isset($question['sub_section']) && ! empty($question['sub_section']) )
                            @foreach($question['sub_section'] as $_key => $_question)
                                <p class="mb-0"><strong>{{$_question['label']}}</strong></p>
                                <p class="text-muted mb-0">
                                    {!! $currentReviewDetail != false && $currentReviewDetail->subActivity != null ? $currentReviewDetail->subActivity()->pluck('response')->first() : '' !!}
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif

        @endif
    @endforeach
</form>