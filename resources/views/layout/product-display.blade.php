@php
	use App\Models\sepatu;
	use App\Models\DetailSepatu;
	$userLoggedIn = Session::get('userLoggedIn');

	$listDetail = DetailSepatu::all();

	$price = 0;
	$gambar = '';

@endphp

<section class="lattest-product-area pb-40 category-list">
    <div class="row">
        @forelse ($listSepatu as $key=>$sepatu)
        <!-- single product -->  
                @foreach ($listDetail as $key => $detail) 
                    @if ($detail->detail_sepatu_id == $sepatu->sepatu_id)
                        @php
                            $price = $detail->detail_sepatu_harga ;
                            $gambar = $detail->detail_sepatu_gambar ; 
                        @endphp
                    @endif
                @endforeach
                <a href="{{ route('product-detail', $sepatu->sepatu_id) }}">
                <div class="col-lg-4 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="{{ Storage::url("photo/$gambar") }}" alt="">
                        <div class="product-details">
                            <h6>{{ $sepatu->sepatu_name }}</h6>
                            <div class="price">
                                <h6>{{ formatCurrencyIDR($price) }}</h6>
                                <h6 class="l-through">{{ formatCurrencyIDR($price + 50000) }}</h6>
                            </div>
                            
                            <div class="prd-bottom">
                                <a href="{{ route('add-to-cart', $sepatu->sepatu_id) }}" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">add to bag</p>
                                </a>
                                <a href="{{ route('checkout-product', $sepatu->sepatu_id) }}" class="social-info">
                                    <span class="ti-money"></span>
                                    <p class="hover-text">checkout</p>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                </a>
            
        @empty
            <h1 style="margin:auto">No Products Yet</h1>
        @endforelse
    </div>
</section>