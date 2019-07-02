@extends('template.template')

@section('content')
            <h1 class="page-header">Keuangan</h1>
            
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('pengeluaran') }}" class="btn btn-primary">Pengeluaran</a></li>
                    <li><a href="{{ url('pemasukan') }}" class="btn btn-primary">Pemasukan</a></li>
					<li class="active"><a href="saldo" id="pengeluaran" data-toggle="tab">Saldo</a></li>
                </ul>
                
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="saldo">

                    <h3 class="page-header">{{ $title }}</h3>
            
            <p></p>


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="2%">No</th>
						<th>Pemasukan</th>
						<th>Pengeluaran</th>
						<th>Total Saldo</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>#</td>
							<td>{{ number_format($a) }}</td>
							<td>{{ number_format($b) }}</td>
							<td>{{ number_format($a - $b) }}</td>
                        </tr>
                </tbody>
            </table>
			

                    </div>

                    <div class="tab-pane"></div>
                    
                </div>

@stop