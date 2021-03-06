@extends('layout')
@section('title', 'Packing List')
@section('content')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Procurement</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        {{-- Content here --}}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Packing List</h2>
                        <a href="{{route('packing-list.create')}}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="table-responsive">
                            <table class="table table-bordered datatable-buttons">
                                <thead class="bg-primary">
                                    <tr>
                                        <th width="30">#</th>
                                        <th>Commercial Invoice No</th>
                                        <th>Commercial Invoice Date</th>
                                        <th>Currency</th>
                                        <th width="40">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packing_list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->commercial_invoice->commercial_invoice_no}}</td>
                                        <td>{{$item->commercial_invoice->date}}</td>
                                        <td>{{$item->currency}}</td>
                                       <td class="text-center">
                                            <a href="{{route('packing-list.show',$item)}}" class="btn btn-block btn-default btn-xs"><i class="fa fa-eye"></i>View</a>
                                        </td>
                                    </tr>
                                      @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end table-->
                    </div>
                </div>
            </div>
        </div>
        {{--end content here--}}
    </div>
@endsection
