            {!! Form::open(
                ['route' => [$cari . '.store'], 
                    'role'  => 'form',
                    'method'=> 'post',
                    'class' => 'form-inline']) !!}
					
                <div class="form-group">
                    {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Kunci']) !!}
                    {{ Form::hidden('route', $route) }}
                    {!! Form::button('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </div>
                
                @if ($route != 'jejak-pelanggan')
                
                    @include('template.tambah')

                @endif
                
            {!! Form::close() !!}