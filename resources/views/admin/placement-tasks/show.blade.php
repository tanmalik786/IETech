@extends('admin.layout.app')

@section('page-title')
    Placement Task Entry
@endsection

@section('page-subtitle')
@endsection

@push('page-styles')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        tr[data-day="Monday"] {
            background: rgba(124, 166, 217, 0.3)
        }
    </style>
@endpush

@section('page-breadcrumb')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message'))
                        {!! session()->get('message'); !!}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-row">
                                    <h4>Planning</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-hover planning">
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>Focus</th>
                                            <th>Notes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse( $placement_task->plannings as $key => $planning )
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="focus[]" value="{{$planning->focus}}">
                                                    {!! $planning->focus !!}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="notes[]" value="{{$planning->notes}}">
                                                    {!! $planning->notes !!}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">no data found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-row">
                                    <h4>Meeting Student Needs</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! $placement_task->student_needs !!}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-row">
                                    <h4>Differentiation</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-hover differential">
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>Strategy</th>
                                            <th>Comments</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse( $placement_task->differentials as $key => $differential )
                                            <tr>

                                                <td>
                                                    <input type="hidden" name="strategy[]" value="{{$differential->strategy}}">
                                                    {!! $differential->strategy !!}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="comments[]" value="{{$differential->comments}}">
                                                    {!! $differential->comments !!}
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">no data found, add item</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-row">
                                    <h4>Embed English, Mathematics, and Digital IT skills</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-hover stem">
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>Key Skill</th>
                                            <th>Plan <i class="fa fa-info-circle" title="Plans for meaningful embedding and assessment"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse( $placement_task->stems as $key => $stems )
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="key_skill[]" value="{{$stems->key_skill}}">
                                                    {!! $stems->key_skill !!}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="plan[]" value="{{$stems->plan}}">
                                                    {!! $stems->plan !!}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">no data found, add item</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-scripts')

@endpush