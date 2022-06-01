@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">


    {{-- models --}}
    <!---Internal Owl Carousel css-->
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Exercises</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Exercises</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="modal-body">
        <form action="{{ route('exercises.store') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="exampleInputEmail1">exercise Name</label>
                <input type="text" class="form-control" id="section_name" name="exercise_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">exercise contant</label>
                <input type="text" class="form-control" id="section_name" name="exercise_contant">
            </div>

            <div class="form-group row justify-content-center">

                <input type="text" id="count-hourse" placeholder="Hourse(s)" value="30:00" class="form-control col-4">
                <label>Hourse(s)</label>
                <span class="counter-text">
                    | {{ trans('Seconds ') }} <span id="countdowntimer"> 60</span>
                </span>
                <input type="text" id="count-minute" placeholder="Mintes(s)" value="02:00" class="form-control col-4">
                <label>Minutes(s)</label>
                <span class="counter-text">
                    | {{ trans('minutes ') }} <span id="countdowntimer2"> 60</span>
                </span>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/js/myscript.js') }}"></script>

    {{-- <script type="text/javascript">
        alert('dsf');
        var sminute = 30;
        var mtime = sminute * 60;
        var document.getElementById("count-hourse");
        var document.getElementById("count-minute");
    </script> --}}
@endsection
