@extends('template.template')

@section('content')
           
            <img src="{{ asset('admin/images/inventory.png') }}" style="height:50px; width:90px; margin-top:35px; margin-bottom:-10px;" title="logo sbs" alt="logo sbs">
			<div style="margin-top:-31px; margin-left: 90px; font-size: 23px;">
                    <strong>Body Repair Oven System</strong>
                </div>
			<hr>
            <div class="table-responsive">
               <center>
                    <table border="0" class="dt-table">
                        <tr>
                            <td></td>

                            <td></td>

                            <td>
                                <a href="{{ URL('pelanggan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Pelanggan
                                </a>
                            </td>

                            <td></td>
                            <td></td>

                            <td></td>

                            <td></td>

                        </tr>

                        <tr>
                            <td>
                                <a href="{{ URL('suplier/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Supplier
                                </a>
                            </td>

                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>
                            
                            <td></td>
                            <td>
                                
                            </td>

                            <td></td>

                            <td></td>

                        </tr>

                        <tr>

                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>
                            
                            <td>
                                <img src="{{asset('admin/images/arrow/29.png')}}">
                            </td>
                            <td>
                                <a href="{{ URL('kendaraan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Kendaraan
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('pre-so/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Transaksi Kendaraan
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/17.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('asuransi/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Asuransi
                                </a>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <a href="{{ URL('order-barang/') }}" id="keluhan" class="btn btn-default btn-block">
                                    <img src="{{ asset('admin/images/icon/folder_add.png') }}"> 
                                    Order Barang
                                </a>
                            </td>
                            
                            <td>
                                <img src="{{asset('admin/images/arrow/30.png')}}">
                            </td>

                            <td></td>
                            
                            <td></td>
                            
                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td></td>

                            <td></td>

                        </tr>

                        <tr>
                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/28.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('barang/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Barang
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('ekstimasi/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Pre Invoice
                                </a>
                            </td>

                            <td></td>

                            <td></td>

                        </tr>

                        <tr>
                            <td></td>
                            
                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/16.png')}}">
                            </td>

                            <td></td>
                            
                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td></td>
                            <td></td>

                        </tr>

                        <tr>
                            <td>
                                <a href="{{ URL('satuan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Satuan
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('merek/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Merek
                                </a>
                            </td>

                            <td></td>

                            <td>
                                <a href="{{ URL('tagihan-or/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Tagihan
                                </a>
                            </td>

                            <td></td>
                            <td></td>

                        </tr>


                        <tr>
                            <td></td>
                            <td></td>

                            <td></td>

                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td></td>
                            
                            <td></td>
                        </tr>

                        <tr>
                            <td>
                                <a href="{{ URL('laporan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Laporan
                                </a>
                            </td>
                            
                            <td></td>

                            <td>
                                <a href="{{ URL('operasional/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Operasional
                                </a>
                            </td>

                            <td></td>

                            <td>
                                <a href="{{ URL('pengeluaran/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Keuangan
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('jejak-pelanggan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Status Pelanggan
                                </a>
                            </td>

                        </tr>
                    </table>
                </center>
            </div><!-- /.table-responsive -->

@stop