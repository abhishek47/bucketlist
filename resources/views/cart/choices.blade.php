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
								<th>Price</th>
							</tr>
							@foreach($cart['items'] as $product)
								<tr>
									<td>{{ $product->name }}</td>
									<td>{{ $product->price }}</td>
								</tr>
							@endforeach
						</thead>
					</table>
				</div>
				@endforeach


			</div>
		</div>
	</div>

@endsection