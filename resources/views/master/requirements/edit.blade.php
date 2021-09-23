@extends('layouts.app', ['active' => 'master_testing'])
@section('header')
    <div class="page-header page-header-default">
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="#"><i class="icon-home2 position-left"></i> Master Data</a></li>
                <li class="active">Master Testing</li>
            </ul>
        </div>
    </div>
@endsection



@section('content')
    <div class="content">
        <div class="row">
            <div class=" panel panel-flat">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    @foreach ($requirements as $requirement)
                        <form action="{{ route('requirements.update') }}" id="form-update" method="POST">
                            {{ csrf_field() }}


                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Detail Requirement Code</label>
                                            <input type="hidden" name="id" id="id" value="{{ $requirement->id }}"
                                                class="form-control">

                                            <input type="text" name="requirement_code" id="requirement_code"
                                                value="{{ $requirement->requirement_code }}" class="form-control"
                                                placeholder="Input Method code ">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Method Code</label>

                                            <select name="master_method_id" id="master_method_id" class="form-control">

                                                @foreach($master_methods as $master_method)

                                                    @if($master_method->id == $requirement->master_method_id)
                                                        <option value="{{ $master_method->id }}" selected hidden>{{ $master_method->method_name }}</option>
                                                    @else
                                                        <option value="{{ $master_method->id }}">{{ $master_method->method_name }}</option>
                                                    @endif

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Method Category Code</label>

                                            <select name="master_category_id" id="master_category_id" class="form-control">

                                                @foreach($master_categorys as $master_category)

                                                    @if($master_category->id == $requirement->master_category_id)
                                                        <option value="{{ $master_category->id }}" selected hidden>{{ $master_category->category }}</option>
                                                    @else
                                                        <option value="{{ $master_category->id }}">{{ $master_category->category }}</option>
                                                    @endif

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Komposisi Specimen</label>

                                            <input type="text" name="komposisi_specimen" id="komposisi_specimen"
                                                class="form-control" value="{{ $requirement->komposisi_specimen }}"
                                                placeholder="Input Komposisi Specimen ">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Parameter</label>

                                            <input type="text" name="parameter" id="parameter" class="form-control"
                                                value="{{ $requirement->parameter }}" placeholder="Input Parameter ">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Perlakuan Test</label>

                                            <input type="text" name="perlakuan_test" id="perlakuan_test"
                                                class="form-control" value="{{ $requirement->perlakuan_test }}"
                                                placeholder="Input Perlakuan Test">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Operator</label>

                                            <input type="text" name="operator" id="operator" class="form-control"
                                                value="{{ $requirement->operator }}" placeholder="Input Operator ">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Uom</label>

                                            <input type="text" name="uom" id="uom" class="form-control"
                                                value="{{ $requirement->uom }}" placeholder="Input UOM">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 1</label>

                                            <input type="text" name="value1" id="value1" class="form-control"
                                                value="{{ $requirement->value1 }}" placeholder="Input Value 1">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 2</label>

                                            <input type="text" name="value2" id="value2" class="form-control"
                                                value="{{ $requirement->value2 }}" placeholder="Input Value 2">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 3</label>

                                            <input type="text" name="value3" id="value3" class="form-control"
                                                value="{{ $requirement->value3 }}" placeholder="Input Value 3">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 4</label>

                                            <input type="text" name="value4" id="value4" class="form-control"
                                                value="{{ $requirement->value4 }}" placeholder="Input Value 4">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 5</label>

                                            <input type="text" name="value5" id="value5" class="form-control"
                                                value="{{ $requirement->value5 }}" placeholder="Input Value 5">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 6</label>

                                            <input type="text" name="value6" id="value6" class="form-control"
                                                value="{{ $requirement->value6 }}" placeholder="Input Value 6">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Value 7</label>

                                            <input type="text" name="value7" id="value7" class="form-control"
                                                value="{{ $requirement->value7 }}" placeholder="Input Value 7">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <label class="display-block text-semibold">Remarks</label>

                                            <input type="text" name="remarks" id="remarks" class="form-control"
                                                value="{{ $requirement->remarks }}" placeholder="Input Remarks">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-blue-success col-xs-12" style="margin-top: 15px">Update <i
                                    class="icon-floppy-disk position-right"></i></button>

                        </form>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection




@section('js')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#master_method_id').select2({
        //         ajax: {
        //             url: '/master/master-requirements/getMethodMaster',
        //             dataType: 'json',
        //             delay: 250,
        //             // data: function(params) {
        //             //     return {
        //             //         subdept: params.term
        //             //     };
        //             // },
        //             processResults: function(data) {
        //                 return {
        //                     results: $.map(data, function(item) {
        //                         return {
        //                             text: item.method_code,
        //                             id: item.method_code
        //                         }
        //                     })
        //                 };
        //             },
        //             cache: true
        //         }
        //     });
        // });
    </script>
@endsection
