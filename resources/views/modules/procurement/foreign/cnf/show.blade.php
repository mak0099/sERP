@extends('layout')
@section('title', 'Duty TAX, VAT and CNF Bill')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Procurement</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Duty TAX, VAT and CNF Bill Details</h2>
                        <div class="btn-group pull-right">
                            <button class="btn btn-sm btn-info print-btn" value='Print'><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                            <a href="{{route('cnf.index')}}" class="btn btn-sm btn-success btn-addon"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Duty TAX, VAT and CNF Bill List</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="table-responsive DivIdToPrint">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Consignee:</strong> 125</td>
                                        <td><strong>Bill No:</strong> 125</td>
                                        <td><strong>Bill Date:</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>LC No:</strong> 125</td>
                                        <td><strong>LC Opening Date:</strong> 125</td>
                                        <td><strong>LC Value:</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Commercial invoice No:</strong> 125</td>
                                        <td><strong>Commercial Invoice Date:</strong> 125</td>
                                        <td><strong>B/L No:</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>B/L Date:</strong> 125</td>
                                        <td><strong>B/E No:</strong> 125</td>
                                        <td><strong>B/E Date:</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Arrival Date:</strong> 125</td>
                                        <td><strong>Delivery Date:</strong> 125</td>
                                        <td><strong>Job No:</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Exporter:</strong> 125</td>
                                        <td><strong>C&F Value:</strong> 125</td>
                                        <td><strong>USD Amount:</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Exchange Rate:</strong> 125</td>
                                        <td><strong>BDT Amount:</strong> 125</td>
                                        <td><strong>CNF Agent :</strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Exporter:</strong></td>
                                        <td><strong>Duty Payment Date:</strong> 125</td>
                                        <td><strong>Container No:</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4">Particulars of Consignments Table:</th>
                                    </tr>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Particulars of Consignments</th>
                                        <th>Taka</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>abc</td>
                                        <td>125</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><strong>Voucher Tk=</strong></td>
                                        <td><strong></strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><strong>Voucher Tk=</strong></td>
                                        <td><strong></strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><strong>Previous Due Tk=</strong></td>
                                        <td><strong></strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><strong>Total Voucher Tk=</strong> </td>
                                        <td><strong></strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><strong>Cash Received/Pay Order Tk=</strong></td>
                                        <td><strong></strong> 125</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="2"><strong>Due Tk=</strong></td>
                                        <td><strong></strong> 125</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tbody>
                                <td><strong>Amount In Word:</strong>125</td>
                                </tbody>
                                <tbody>
                                <td><strong>Notes:</strong>125</td>
                                </tbody>
                            </table>
                            <!--start approved by-->
                            <table id="print-footer" style="position: absolute; bottom: 30px; width: 100%; display: none;">
                                <tr>
                                    <td style="text-align: center; font-weight: bold;">
                                        <span style="border-top: 2px solid black;"> Prepared By</span>
                                    </td>
                                    <td style="text-align: center; font-weight: bold;">
                                        <span style="border-top: 2px solid black;"> Checked By</span>
                                    </td>
                                    <td style="text-align: center; font-weight: bold;">
                                        <span style="border-top: 2px solid black;"> Approved By</span>
                                    </td>
                                </tr>
                            </table>
                            <!--end approved by-->
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
