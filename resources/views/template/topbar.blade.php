        
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Sistem Transaksi Bengkel</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">

                            {{--$row = BarangMasuk::belumLengkap()->get();
                            $gr = $row->count() > 0 ? "btn-success" :""; --}}
                            
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle {{--$gr--}}" title="Notifikasi BBM yang belum lengkap" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{-- $row->count() --}} &nbsp;<span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span></a>
                            <!--{{--if ($row->count() <= 0): --}}-->
                            <ul class="dropdown-menu">
                                <li><a href="#">Tidak ada notifikasi</a></li>		
                            </ul>
                            {{--else: --}}
                                <ul class="dropdown-menu">
                                {{--foreach($row as $rs): --}}
                                    <li class="btn-success"><a style="margin-right: 20px;" href="item_in/edit/$rs->id"><h4 style="float: left;margin-right: 4px; margin-top: 6px;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></h4> $rs->nomor<br>
                                    <small>tglindo($rs->tanggal)</small></a></li>		
                                {{--endforeach;--}}
                                </ul>
                            {{--endif; --}}
                        </li>
                        <li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Beranda</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>{{ Auth::user()->name }}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('user') }}"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Ganti Password</a></li>
                                <li class="divider"></li>
                                {{--if ($this->session->userdata('grup_id')==1):--}}
                                <li><a href="user"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Pengguna</a></li>
                                <li><a href="group"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Grup</a></li>
                                <li class="divider"></li>
                                {{--endif--}}
                                <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>