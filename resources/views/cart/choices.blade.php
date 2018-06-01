@extends('layouts.app')



@section('content')
	
	<div class="container my-4">
		<div class="card">
			<div class="card-body">
				<h3 class="font-weight-bold pb-3">Shopping Cart Choices</h3>
				<hr>

				@foreach($carts as $cart)
				<div style="margin-bottom: 25px;">
					<table class="table table-stripped" style="font-size: 20px;">
						<thead class="thead-dark">
							<tr>
								<th>Name</th>
								<th style="text-align: right;">Price</th>
							</tr>
							@foreach($cart['items'] as $product)
								<tr>
									<td>{{ $product->name }}</td>
									<td style="text-align: right;">&#8377; {{ $product->price }}</td>
								</tr>
							@endforeach
							<tr>
								<td></td>
								<td style="text-align: right;font-weight: bold;">
									Total : &#8377; {{ $cart['total'] }}
								</td>
							</tr>

							<tr>
								<td style="font-weight: bold;">You Save : &#8377; {{ session('budget') - $cart['total'] }}</td>
								<td style="text-align: right;">
									<a class="btn btn-warning" href="/cart/choose">Choose This Cart</a>
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