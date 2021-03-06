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
    <!-- row -->
    <div class="row row-sm">


        <!--/div-->
        <div class="col-sm-6 col-md-4 col-xl-3 text-md-right m-2">
            <a class="btn btn-primary btn-block"  href="{{ route('exercises.create') }}">Add New Exercise</a>
        </div>

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Bordered Table</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">ID</th>
                                    <th class="border-bottom-0">Exercises name</th>
                                    <th class="border-bottom-0">Exercises contant</th>
                                    <th class="border-bottom-0">Start date</th>
                                    <th class="border-bottom-0">End date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exercises  as $exercise)
                                    <tr>
                                        <td>{{ $exercise->id }}</td>
                                        <td>{{ $exercise->exercise_name }}</td>
                                        <td>{{ $exercise->exercise_contant }}</td>
                                        <td>{{ $exercise->exercise_start_date }}</td>
                                        <td>{{ $exercise->exercise_end_date }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    <!-- Basic modal -->
		<div class="modal" id="modaldemo1">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
                        <h6 class="modal-title">Add New Category</h6><button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories.store') }}" method="post">
                            {{ csrf_field() }}
    
                            <div class="form-group">
                                <label for="exampleInputEmail1">exercise Name</label>
                                <input type="text" class="form-control" id="section_name" name="exercise_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">exercise contant</label>
                                <input type="text" class="form-control" id="section_name" name="exercise_contant">
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="section_name" name="name">
                            </div>
                            <label class="form-group">
                                <input type="checkbox" class="form-control" id="section_name" name="active" checked>
                                <span></span>
                            </label> --}}
                            {{-- <div class="form-group">
                                <label for="exampleFormControlTextarea1">??????????????</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div> --}}
    
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">??????????</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">??????????</button>
                            </div>
                        </form>
                    </div>
				</div>
			</div>
		</div>
		<!-- End Basic modal -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection
