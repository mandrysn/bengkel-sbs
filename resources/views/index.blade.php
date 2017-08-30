@extends('template.template')

@section('content')
           
            <img src="{{ asset('admin/images/inventory.png') }}" style="height:35px; width:40px; margin-top:35px;" title="logo sbs" alt="logo sbs"><hr>
            <div class="table-responsive">
               <center>
                    <table border="0" class="dt-table">
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
                                <img src="{{asset('admin/images/arrow/9.png')}}">
                            </td>
                            <td>
                                <a href="{{ URL('servis-order/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Input SO
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/18.png')}}">
                            </td>

                            <td>
                                <a href="{{ URL('pelanggan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Jejak Pelanggan
                                </a>
                            </td>

                            <td></td>

                            <td></td>
                        </tr>

                        <tr>
                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/3.png')}}">
                            </td>

                            <td></td>

                            <td>
                                <img src="{{asset('admin/images/arrow/3.png')}}">
                            </td>
                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/3.png')}}">
                            </td>

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

                            <td>
                                <a href="{{ URL('asuransi/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Asuransi
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/7.png')}}">
                            </td>
                            <td>
                                <a href="{{ URL('ekstimasi/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Ekstimasi
                                </a>
                            </td>
                            <td>
                                <img src="{{asset('admin/images/arrow/3.png')}}">
                            </td>
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

                            <td>
                                <img src="{{asset('admin/images/arrow/3.png')}}">
                            </td>

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
                                    Pemesanan Barang
                                </a>
                            </td>

                            <td>
                                <img src="{{asset('admin/images/arrow/23.png')}}">
                            </td>

                            <td>
                                <a href="{{URL('tagihan/')}}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Tagihan OR
                                </a>
                            </td>
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
                            <td>
                                <img src="{{asset('admin/images/arrow/15.png')}}">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>

                            <td>
                                <a href="{{ URL('order-material/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Barang Material
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
                                <a href="{{ URL('keuangan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Keuangan
                                </a>
                            </td>
                            <td>
                                <img src="{{asset('admin/images/arrow/4.png')}}">
                            </td>
                            <td>
                                <a href="{{ URL('laporan/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/bookmark.png')}}"> 
                                    Laporan
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td></td><td></td>

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
                                <a href="{{ URL('material/') }}" class="btn btn-default btn-block">
                                    <img src="{{asset('admin/images/icon/folder_add.png')}}"> 
                                    Tagihan
                                </a>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </center>
            </div><!-- /.table-responsive -->
@stop