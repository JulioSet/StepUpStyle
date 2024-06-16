@php 
    use App\Models\sepatu;
    use App\Models\DetailSepatu;
	$userLoggedIn = Session::get('userLoggedIn');	
	$listSepatu = sepatu::inRandomOrder()->limit(6)->get();
    $listDetail = DetailSepatu::all();

    $price = 0;
	$gambar = '';
@endphp

<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="section-title">
                    <h1>Deals of the Week</h1>
                    <p>Unleash unbeatable style at incredible savings with our Deals of the Week Shoes! </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($listSepatu as $key => $sepatu)   
                        {{-- @foreach ($listDetail as $key => $detail) 
                            @if ($detail->detail_sepatu_id == $sepatu->sepatu_id)
                                @php
                                    $price = $detail->detail_sepatu_harga ;
                                    $gambar = $detail->detail_sepatu_pict ; 
                                @endphp
                            @endif
                        @endforeach     --}}
                        @php
                            $price = $sepatu->details[0]->detail_sepatu_harga ;
                            $gambar =  $sepatu->details[0]->detail_sepatu_pict ; 
                        @endphp
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <a href="{{ route('product-detail', $sepatu->sepatu_id) }}">
                            <div class="single-related-product d-flex">
                            <img src="{{ Storage::url("photo/$gambar") }}" class="object-fit-cover" alt="" style="width:10vw;height:20vh">
                            <div class="desc">
                                <a href="{{ route('product-detail', $sepatu->sepatu_id) }}" class="title">{{ $sepatu->sepatu_name }}</a>
                                <div class="price">
                                    <h6>{{ formatCurrencyIDR($price) }}</h6>
                                    <h6 class="l-through">{{ formatCurrencyIDR($price + 50000) }}</h6>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>            
        </div>
    </div>
</section>