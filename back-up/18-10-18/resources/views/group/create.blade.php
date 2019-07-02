@extends('template.template')

@section('content')
 <h1 class="page-header">{{ $title }}</h1>
            
            @include('template.notification')

            {!! Form::open(
               ['route' => [$route.'.store'], 
                'role'  => 'form',
                'method'=> 'post',
                'class' => 'form-horizontal',
                'files' => 'true']) !!}


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
					{{ $m->nama_modul }}</label></td>
	
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



	jQuery("#6").click(function () {

    	jQuery(".s6").not(this).prop('checked', this.checked);

	});



	jQuery("#7").click(function () {

    	jQuery(".s7").not(this).prop('checked', this.checked);

	});



	jQuery("#8").click(function () {

    	jQuery(".s8").not(this).prop('checked', this.checked);

	});



	jQuery("#9").click(function () {

    	jQuery(".s9").not(this).prop('checked', this.checked);

	});



	jQuery("#10").click(function () {

    	jQuery(".s10").not(this).prop('checked', this.checked);

	});



	jQuery("#11").click(function () {

    	jQuery(".s11").not(this).prop('checked', this.checked);

	});



	jQuery("#12").click(function () {

    	jQuery(".s12").not(this).prop('checked', this.checked);

	});



	jQuery("#13").click(function () {

    	jQuery(".s13").not(this).prop('checked', this.checked);

	});



	jQuery("#14").click(function () {

    	jQuery(".s14").not(this).prop('checked', this.checked);

	});



	jQuery("#15").click(function () {

    	jQuery(".s15").not(this).prop('checked', this.checked);

	});



	jQuery("#16").click(function () {

    	jQuery(".s16").not(this).prop('checked', this.checked);

	});



	jQuery("#17").click(function () {

    	jQuery(".s17").not(this).prop('checked', this.checked);

	});



	jQuery("#18").click(function () {

    	jQuery(".s18").not(this).prop('checked', this.checked);

	});



	jQuery("#19").click(function () {

    	jQuery(".s19").not(this).prop('checked', this.checked);

	});

	jQuery("#20").click(function () {

    	jQuery(".s20").not(this).prop('checked', this.checked);

	});

	jQuery("#21").click(function () {

    	jQuery(".s21").not(this).prop('checked', this.checked);

	});

	jQuery("#22").click(function () {

    	jQuery(".s22").not(this).prop('checked', this.checked);

	});

</script>
@endsection