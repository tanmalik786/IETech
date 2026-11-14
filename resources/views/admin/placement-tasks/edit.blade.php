@extends('admin.layout.app')

@section('page-title')
    Edit Placement Task Entry
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
                    <form action="{{route('admin.placement-tasks.update', ['placement_task' => $placement_task->id])}}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-row">
                                    <h4>Planning</h4>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-primary" data-target="#addPlanning" data-toggle="modal"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-hover planning">
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Focus</th>
                                            <th>Notes</th>
                                            <th>Action</th>
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
                                                <td>
                                                    <a href="javascript:void(0)" onclick="edit({{$key}},'planning')" data-toggle="modal" data-target="#editPlanning"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)" onclick="remove({{$key}},'planning')" ><i class="fa fa-trash-alt"></i></a>
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
                                    <h4>Meeting Student Needs</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea name="student_needs" id="" cols="30" rows="10" class="summernote form-control">{!! $placement_task->student_needs !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between flex-row">
                                    <h4>Differentiation</h4>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-primary" data-target="#addDifferential" data-toggle="modal"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-hover differential">
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Strategy</th>
                                            <th>Comments</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse( $placement_task->differentials as $key => $differential )
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="strategy[]" value="{{$differential->strategy}}">
                                                    {!! $differential->strategy !!}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="comments[]" value="{{$differential->comments}}">
                                                    {!! $differential->comments !!}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="edit({{$key}},'differential')" data-toggle="modal" data-target="#editDifferential"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)" onclick="remove({{$key}},'differential')" ><i class="fa fa-trash-alt"></i></a>
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
                                    <a href="javascript:void(0)" class="btn btn-icon btn-primary" data-target="#addStem" data-toggle="modal"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-wrapper">
                                    <table class="table table-bordered table-hover stem">
                                        <thead class="thead-primary">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Key Skill</th>
                                            <th>Plan <i class="fa fa-info-circle" title="Plans for meaningful embedding and assessment"></i></th>
                                            <th>Action</th>
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
                                                <td>
                                                    <a href="javascript:void(0)" onclick="edit({{$key}},'stem')" data-toggle="modal" data-target="#editStem"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)" onclick="remove({{$key}},'stem')" ><i class="fa fa-trash-alt"></i></a>
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
                            <div class="card-footer">
                                <a class="btn btn-default" href="{{URL::Previous()}}">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('admin.placement-tasks.modals.addPlanning')
    @include('admin.placement-tasks.modals.editPlanning')
    @include('admin.placement-tasks.modals.addDifferential')
    @include('admin.placement-tasks.modals.editDifferential')
    @include('admin.placement-tasks.modals.addStem')
    @include('admin.placement-tasks.modals.editStem')
@endsection

@push('page-scripts')
    <script src="{{asset('vendor/adminlte/plugins/summernote/summernote.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>

      $('textarea').summernote({
        minHeight: 100
      });

      let plannings = <?php echo json_encode($placement_task->plannings()->get(['focus', 'notes'])); ?>;
      let differentials = <?php echo json_encode($placement_task->differentials()->get(['strategy', 'comments'])); ?>;
      let stem = <?php echo json_encode($placement_task->stems()->get(['key_skill', 'plan'])); ?>

          console.log(plannings, differentials, stem);

      $('#addPlanning').on('shown.bs.modal', function () {
        $(this).find('modal').trigger('reset')
      })
      $('#addDifferential').on('shown.bs.modal', function () {
        $(this).find('modal').trigger('reset')
      })
      $('#addStem').on('shown.bs.modal', function () {
        $(this).find('modal').trigger('reset')
      })

      $('.update-placement-tasks-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission behavior
        var form = $(this); // Get the form that was submitted
        var type = form.find('[name=type]').val();

        if( type == 'planning' ) {

          let id = form.find('[name="id"]').val();
          let focus = form.find('[name="focus"]').val();
          let notes = form.find('[name="notes"]').val();

          let data = {
            focus : focus,
            notes : notes
          }

          plannings[id] = data;
          $('#editPlanning').modal('hide');
          form.trigger('reset');

          drawTable( 'planning' );
        } else if ( type == 'differential' ) {

          let id = form.find('[name="id"]').val();
          let strategy = form.find('[name="strategy"]').val();
          let comments = form.find('[name="comments"]').val();

          let data = {
            strategy : strategy,
            comments : comments
          }

          differentials[id] = data;
          $('#editDifferential').modal('hide');
          form.trigger('reset');

          drawTable( 'differential' );
        } else {
          let id = form.find('[name="id"]').val();
          let key_skill = form.find('[name="key_skill"]').val();
          let plan = form.find('[name="plan"]').val();

          let data = {
            key_skill : key_skill,
            plan : plan
          }

          stem[id] = data;
          $('#editStem').modal('hide');
          form.trigger('reset');

          drawTable( 'stem' );
        }
      });


      $('.placement-tasks-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission behavior
        var form = $(this); // Get the form that was submitted
        var type = form.find('[name=type]').val();

        if( type == 'planning' ) {

          let focus = form.find('[name="focus"]').val();
          let notes = form.find('[name="notes"]').val();
          let data = {
            focus : focus,
            notes : notes
          }

          plannings.push( data );
          $('#addPlanning').modal('hide');
          form.trigger('reset');

          drawTable( 'planning' );
        } else if ( type == 'differential') {
          let strategy = form.find('[name="strategy"]').val();
          let comments = form.find('[name="comments"]').val();

          let data = {
            strategy : strategy,
            comments : comments
          }

          differentials.push(data);
          $('#addDifferential').modal('hide');
          form.trigger('reset');

          drawTable( 'differential' );
        } else {
          let key_skill = form.find('[name="key_skill"]').val();
          let plan = form.find('[name="plan"]').val();

          let data = {
            key_skill : key_skill,
            plan : plan
          }

          stem.push(data);
          $('#addStem').modal('hide');
          form.trigger('reset');

          drawTable( 'stem' );
        }
      });


      function drawTable( type ) {
        if ( type == 'planning') {
          let table = $('.planning');
          let rows = '';
          if( plannings.length > 0 ) {
            plannings.forEach((planning,index) => {
              rows += `<tr>
                            <td>${index + 1}</td>
                            <td>
                                ${planning.focus}
<input type="hidden" name="focus[]" value="${planning.focus}">
                            </td>
                            <td>${planning.notes}<input type="hidden" name="notes[]" value="${planning.notes}"></td>
                            <td>
                                <a href="javascript:void(0)" onclick="edit(${index},'planning')" data-toggle="modal" data-target="#editPlanning"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" onclick="remove(${index},'planning')" ><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>`;
            });

            table.find('tbody').html(rows);
          } else {
            rows = `<tr><td colspan="4">No Data</td></tr>`;
            table.find('tbody').html(rows);
          }
        } else if ( type == 'differential') {
          let table = $('.differential');
          let rows = '';
          if( differentials.length > 0 ) {
            differentials.forEach((differential,index) => {
              rows += `<tr>
                            <td>${index + 1}</td>
                            <td>
                                ${differential.strategy}
<input type="hidden" name="strategy[]" value="${differential.strategy}">
                            </td>
                            <td>${differential.comments}<input type="hidden" name="comments[]" value="${differential.comments}"></td>
                            <td>
                                <a href="javascript:void(0)" onclick="edit(${index},'differential')" data-toggle="modal" data-target="#editDifferential"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" onclick="remove(${index},'differential')" ><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>`;
            });

            table.find('tbody').html(rows);
          } else {
            rows = `<tr><td colspan="4">No Data</td></tr>`;
            table.find('tbody').html(rows);
          }
        } else {
          let table = $('.stem');
          let rows = '';
          if( stem.length > 0 ) {
            stem.forEach((stm,index) => {
              rows += `<tr>
                            <td>${index + 1}</td>
                            <td>
                                ${stm.key_skill}
<input type="hidden" name="key_skill[]" value="${stm.key_skill}">
                            </td>
                            <td>${stm.plan}<input type="hidden" name="plan[]" value="${stm.plan}"></td>
                            <td>
                                <a href="javascript:void(0)" onclick="edit(${index},'stem')" data-toggle="modal" data-target="#editStem"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" onclick="remove(${index},'stem')" ><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>`;
            });

            table.find('tbody').html(rows);
          } else {
            rows = `<tr><td colspan="4">No Data</td></tr>`;
            table.find('tbody').html(rows);
          }
        }
      }

      function edit(index, type) {
        if( type == 'planning') {
          let data = plannings[index];
          if( data ) {
            $('#editPlanning').find('[name=id]').val(index);
            $('#editPlanning').find('[name=focus]').summernote('code', data.focus);
            $('#editPlanning').find('[name=notes]').summernote('code',data.notes);
            $('#editPlanning').modal('show');
          }
        } else if ( type == 'differential') {
          let data = differentials[index];
          if( data ) {
            $('#editDifferential').find('[name=id]').val(index);
            $('#editDifferential').find('[name=strategy]').summernote('code', data.strategy);
            $('#editDifferential').find('[name=comments]').summernote('code',data.comments);
            $('#editDifferential').modal('show');
          }
        } else {
          let data = stem[index];
          if( data ) {
            $('#editStem').find('[name=id]').val(index);
            $('#editStem').find('[name=key_skill]').summernote('code', data.key_skill);
            $('#editStem').find('[name=plan]').summernote('code',data.plan);
            $('#editStem').modal('show');
          }
        }
      }

      function remove(index, type) {
        if( type == 'planning') {
          plannings.splice(index);
          drawTable('planning');
        } else if( type == 'differential') {
          differentials.splice(index);
          drawTable('differential');
        } else {
          stem.splice(index);
          drawTable('stem');
        }

      }
    </script>
@endpush