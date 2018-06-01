@extends('layouts.app')



@section('content')
	
	<div class="container my-4">
		<div class="card">
			<div class="card-body">
				<h3 class="font-weight-bold pb-3">Shopping Cart Choices</h3>
				<hr>

				@foreach($carts as $cart)
				<div>
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th style="text-align: right;">Price</th>
							</tr>
							@foreach($cart['items'] as $product)
								<tr>
									<td>{{ $product->name }}</td>
									<td style="text-align: right;">{{ $product->price }}</td>
								</tr>
							@endforeach
							<tr>
								<td></td>
								<td style="text-align: right;font-weight: bold;">
									Total : {{ $cart['total'] }}
								</td>
							</tr>
						</thead>
					</table>
				</div>
				@endforeach


			</div>
		</div>
	</div>

@endsection