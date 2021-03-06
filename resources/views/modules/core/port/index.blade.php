@extends('layout')
@section('title', 'Port')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Master Data</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Port</h2>
                        <a href="{{ route('port.create') }}" class="btn btn-sm btn-primary btn-addon pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="popup_area">
                        <br />
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover datatable-buttons">
                                <thead class="bg-primary">
                                    <tr>
                                        <th width="25">#</th>
                                        <th>Port Name</th>
                                        <th>Contact Person Name</th>
                                        <th>Contact Person Phone Number</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th class="text-center" width="40">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($port_list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->contact_person }}</td>
                                        <td>{{ $item->contact_person_number }}</td>
                                        <td>{{ $item->country->name }}</td>
                                        <td>{{ $item->city->name }}</td>
                                        <td class="text-center"><a href="{{ route('port.edit',$item) }}" type="button" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i>Edit</a></td>
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
    </div>
</div>
<!-- /page content -->
@endsection
