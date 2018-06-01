@extends('layouts.app')



@section('content')
	
	<div class="container my-4">
		<div class="card">
			<div class="card-body">
				<h3 class="font-weight-bold pb-3">Your order has been placed successfully</h3>
			
				<hr>

				<h2>Order Summary</h2>
									
				<div style="margin-bottom: 25px;">
					<table class="table table-stripped" style="font-size: 20px;">
						<thead class="thead-dark">
							<tr>
								<th>Name</th>
								<th style="text-align: right;">Price</th>
							</tr>
							@foreach($choosen['items'] as $product)
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
								<td style="font-weight: bold;">You Saved : &#8377; {{ session('budget') - $cart['total'] }}</td>
								<td style="text-align: right;">
								</td>
							</tr>
						</thead>
					</table>
				</div>
				


			</div>
		</div>
	</div>

@endsection