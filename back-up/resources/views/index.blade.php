@extends('template.template')

@section('content')
           
            <img src="{{ asset('admin/images/inventory.png') }}" style="height:50px; width:90px; margin-top:35px; margin-bottom:-10px;" title="logo sbs" alt="logo sbs"><hr>
            <div class="table-responsive">
               <center>
                    <table border="0" class="dt-table">
                        <tr>
                            <td>
                                <a href="{{ URL('asuransi/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Asuransi
                                </a>
                            </td>
                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>
                            <td>
                                <a href="{{ URL('pelanggan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Pelanggan
                                </a>
                            </td>
                            <td>    
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>
                            <td>
                                <a href="{{ URL('kendaraan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Kendaraan
                                </a>
                            </td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td>
                                <a href="{{ URL('gudang/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Gudang
                                </a>
                            </td>
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

                            <td></td>

                            <td></td>
                        </tr>

                        <tr>
                            <td>
                                <a href="{{ URL('merek/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Merek
                                </a>
                            </td>
                            <td>
                                <img src="{{asset('admin/images/arrow/9.png')}}">
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
                                <a href="{{ URL('pre-so/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Transaksi Kendaraan
                                </a>
                            </td>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td>
                                <a href="{{ URL('operasional/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Operasional
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/3.png')}}">
                            </td>

                            <td></td>

                            <td></td>
                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td></td>

                            <td></td>

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
                            <td><img src="{{asset('admin/images/arrow/7.png')}}"></td>

                            <td></td>

                            <td></td>
                            <td>
                                <a href="{{ URL('ekstimasi/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Pre Invoice
                                </a>
                            </td>
                            <td></td>
                            <td></td>


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

                            <td></td><td></td>

                            <td></td>

                        </tr>

                        <tr>
                            <td></td>

                            <td></td>

                            <td>
                                <a href="{{ URL('suplier/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Supplier
                                </a>
                            </td>

                            <td>
                                <img src="{{ asset('admin/images/arrow/4.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('order-barang/') }}" class="btn btn-default btn-block">
                                    <img src="{{ asset('admin/images/icon/folder_add.png') }}"> 
                                    Pemesanan Barang Invoice
                                </a>
                            </td>

                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            
                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>

                            <td>
                                <a href="{{ URL('order-material/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Pesan Barang Pribadi
                                </a>
                            </td>

                            <td><img src="{{asset('admin/images/arrow/4.png')}}"></td>

                            <td>
                                <a href="{{ URL('barang-masuk/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Bukti Barang Masuk
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>
                            
                            <td>
                                <a href="{{ URL('pengeluaran/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Keuangan
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

                            <td>
                                <img src="{{asset('admin/images/arrow/16.png')}}">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td><td></td>

                            <td></td>

                            <td></td>

                            <td>
                                <a href="{{ URL('barang-keluar/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Bukti Barang Keluar
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('tagihan-or/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Tagihan
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