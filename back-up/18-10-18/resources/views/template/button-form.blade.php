                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="{{ route($route.'.index') }}" class="btn btn-default">Kembali</a>
                        {!! Form::submit($button, ['class' => 'btn btn-primary']) !!}
                        
                        @if ($route == 'pemasukan')
                        {{ Form::reset('Reset', ['class' => 'btn btn-danger']) }}
                        @endif
                        
                    </div>
                </div>