@extends('admin.layout.app')

@section('page-title')
    Log teaching Hours
@endsection

@section('page-subtitle')
    <p style="font-size: 0.875rem; line-height: 1" class="mt-2">This is to record your teaching contact time.  For the purpose of this log/record teaching is defined as you</p>
@endsection

@push('page-styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        tr[data-day="Monday"]{
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
                    <form action="{{route('hourslog.store')}}" method="POST">
                        @csrf
                        @include('admin.teach-hours-log.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('admin.teach-hours-log.partials.add-hour-log-modal')
@endsection

@push('page-scripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        let formDataSaved = true;
    </script>
    @include('admin.teach-hours-log.partials.form-js')
    <script>
      let yearRange = '';
      let currentYear = new Date().getFullYear();
      let currentMonth = new Date().getMonth();

      $(document).ready(function() {

        $('select[name=content]').on('change', function() {
          currentYear = $( this ).val();
          initDateBox();
        });

        $('select[name=month]').on('change', function() {
          currentMonth = $( this ).val();
          initDateBox();
        });


        $('select[name=content]').trigger('change');
        $('select[name=month]').trigger('change');

      });

      const initDateBox = () => {
        // const _date = new Date(currentYear, currentMonth, -1);
        $('.datepicker').datepicker({ dateFormat: 'dd/mm/yy' });
      }

      window.onbeforeunload = function() {
        if (formDataSaved === false) {
          return 'Your changes have not been saved yet. Are you sure you want to leave?';
        }
      };

      $('button.btn-form--submit').click(function () {
        window.onbeforeunload = null;
      });

    </script>
@endpush