@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>
            
            @include('template.notification')

            {!! Form::model($group, ['method' => 'PATCH', 'action' => ['GroupController@update', $group->id], 'files' => 'true', 'class' => 'form-horizontal']) !!}


<div class="form-group{{ $errors->has('nama_group') ? ' has-error' : '' }}">
    {{ Form::label('nama_group', null, ['class' => 'col-lg-2 control-label']) }}
    <div class="col-lg-3">
        {{ Form::text('nama_group', null, ['class' => 'form-control', 'placeholder' => 'Nama Group']) }}
        @if($errors->has('nama_group'))
            <span class="help-block">
                <strong>{{ $errors->first('nama_group') }}</strong>
            </span>
        @endif
    </div>
</div>

	<div class="form-group">

		<label for="nama" class="col-lg-1 control-label">Akses</label>

		<div class="col-lg-11">

		<table width="100%" class="table table-responsive table-bordered">

			<thead>

				<tr>

					<th colspan="6">Halaman yang dapat diakses</th>

				</tr>

			</thead>

			<tbody>

			<tr>
			@foreach($modul as $m)
			
			<td width="16%"><label>
				
				{{ Form::checkbox('akses[]', $m->id, null, ['class' => 'sel s' . $m->id]) }}
				{{ $m->nama_modul }}
			</label></td>

			@endforeach

				</tr>

			</tbody>

		</table>

				</div>

	</div>

	<div class="form-group">

		<div class="col-lg-10 col-lg-offset-2">

			<input type=button value=Batal class="btn btn-default" onclick=self.history.back()>

			<button type="submit" class="btn btn-primary">Simpan</button>

		</div>

	</div>



            {!! Form::close() !!}
<script type="text/javascript">

	jQuery("#1").click(function () {

     jQuery('.sel').not(this).prop('checked', this.checked);

	});



	jQuery("#2").click(function () {

    	jQuery(".s2").not(this).prop('checked', this.checked);

	});



	jQuery("#3").click(function () {

    	jQuery(".s3").not(this).prop('checked', this.checked);

	});



	jQuery("#4").click(function () {

    	jQuery(".s4").not(this).prop('checked', this.checked);

	});



	jQuery("#5").click(function () {

    	jQuery(".s5").not(this).prop('checked', this.checked);

	});
	

</script>
@endsection