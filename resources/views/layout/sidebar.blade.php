@php
    use App\Models\kategori;
    use App\Models\supplier;
    use App\Models\DetailSepatu;
    use App\Models\SubKategori;
    $userLoggedIn = Session::get('userLoggedIn');
    $listCategory = kategori::all();
    $listSupplier = supplier::all();
    $listDetail = DetailSepatu::all();
    $listSub = SubKategori::all();
    $listUkuran = [36, 37, 38, 39, 40, 41, 42, 43, 44, 45];
    $listWarna = ['Hitam', 'Putih', 'Merah', 'Biru', 'Abu-abu', 'Coklat'];
@endphp

<div class="col-xl-3 col-lg-4 col-md-5">
    <div class="sidebar-categories">
        <div class="head">Browse Categories</div>
        <ul class="main-categories">
            @forelse ($listCategory as $key=>$category)
                <li class="main-nav-list">
                    <a data-toggle="collapse" href="#{{$category->kategori_nama}}" aria-expanded="false" aria-controls="{{ $category->kategori_id }}"><span class="lnr lnr-arrow-right"></span>{{ $category->kategori_nama }}</a>
                        <ul class="collapse" id="{{$category->kategori_nama}}" data-toggle="collapse" aria-expanded="false" aria-controls="{{ $category->kategori_id }}">
                            @foreach ($listSub as $key=>$sub)
                                @if ($category->kategori_id == $sub->fk_kategori)
                                    <li class="main-nav-list child"><a href="{{ route('product-category', $sub->subkategori_id) }}">{{ $sub->subkategori_nama }}</span></a></li>
                                @endif
                            @endforeach
                            <li class="main-nav-list child"><a href="{{ route('product-category', $category->kategori_id) }}">All {{ $category->kategori_nama }}</span></a></li>
                        </ul>
                        
                    </a>
                </li>
            @empty
                <li class="main-nav-list">
                    <a href="#fruitsVegetable" data-toggle="collapse" aria-expanded="false" aria-controls="fruitsVegetable">
                        <span class="lnr lnr-arrow-right"></span>
                        No Category Yet
                    </a>
                </li>
            @endforelse
        </ul>
    </div>
    <form action="{{ route('filter-products') }}" method="get">
        @csrf
        <div class="sidebar-filter mt-50">
            <div class="top-filter-head">Product Filters</div>
            <div class="common-filter">
                <div class="head">Brands</div>
                <ul>
                    @forelse ($listSupplier as $key=>$supplier)
                        <li class="filter-list">
                            <input class="pixel-radio" type="checkbox" name="brand[]" value="{{ $supplier->supplier_id }}">
                            <label for="{{ $supplier->supplier_name }}">{{ $supplier->supplier_name }}</label>
                        </li>
                    @empty
                        
                    @endforelse
                </ul>
            </div>

            <div class="common-filter">
                <div class="head">Size</div>
                <ul>
                    @forelse ($listUkuran as $key=>$ukuran)
                        <li class="filter-list">
                            <input class="pixel-radio" type="checkbox" id="{{ $ukuran }}" name="size[]" value="{{ $ukuran }}">
                            <label for="{{ $ukuran }}">{{ $ukuran }}</label>
                        </li>
                    @empty
                        
                    @endforelse
                </ul>
            </div>

            <div class="common-filter">
                <div class="head">Color</div>
                <ul>
                    @forelse ($listWarna as $key=>$warna)
                        <li class="filter-list">
                            <input class="pixel-radio" type="checkbox" id="{{ $warna }}" name="color[]" value="{{ $warna }}">
                            <label for="{{ $warna }}">{{ $warna }}</label>
                        </li>
                    @empty
                        
                    @endforelse
                </ul>
            </div>

            <div class="common-filter">
                <div class="head">Price</div>
                <ul>
                    <input type="text" name="min_price" placeholder="Min Price">
                    <input type="text" name="max_price" placeholder="Max Price">
                </ul>
            </div>
            <button class="primary-btn" type="submit" style="width:100%;text-align:center; border: 0">Filter</button>
        </div>
    </form>
</div>
