@extends('layout')
@section('title', 'Working Unit')
@section('content')
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Inventory</h3>
    </div>
</div>
<div class="clearfix"></div>
{{-- Content here --}}

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Inventory Requisition <small>List</small></h2>
                {!! btnAddNew(['url'=>route('issue.create'), 'title'=>'Submit Issue']) !!}
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br/>
            {{-- Main content area --}}
            {{-- @include('partials.paginate_header') --}}
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr class='bg-primary'>
                            <th>Requisition No</th>
                            <th>Type</th>
                            <th>Sender</th>
                            <th>Requested To</th>
                            <th>Item Status</th>
                            <th>Initial Approver</th>
                            <th>Final Approver</th>
                            <th>Remarks</th>
                            <th>Requisition Date</th>
                            <th>Show Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach($paginate->table as $row) --}}
                    @foreach($paginate as $row)
                        <tr>
                            <td>{{ $row->requisition->inventory_requisition_no }}</td>
                            <td>{{ $row->requisition->type->name }}</td>
                            <td>{{ $row->sender->name }}</td>
                            <td>{{ $row->requested_to->name }}</td>
                            <td>{{ $row->requisition->item_status->name }}</td>
                            <td>{{ $row->requisition->initial_approver->name }}</td>
                            <td>{{ $row->requisition->final_approver->name }}</td>
                            <td>{{ $row->requisition->remarks ?? 'Not Specified' }}</td>
                            <td>{{ $carbon->parse($row->requisition->date)->toFormattedDateString() }}</td>
                            <td>{!! btnCustom(['title'=>'Show', 'url'=>route('requisition.show_incoming', ['inventory_issue_request'=>$row->id])]) !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{-- @include('partials.paginate_footer') --}}
            {{-- End of Main content area --}}
           </div>
       </div>
   </div>
</div>


{{-- Content end --}}
</div>
</div>
@endsection