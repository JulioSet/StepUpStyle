@php
    use App\Models\kategori;
    use App\Models\supplier;
    use App\Models\DetailSepatu;
	$userLoggedIn = Session::get('userLoggedIn');
    $listCategory = kategori::All();
    $listSupplier = supplier::All();
    $listDetail = DetailSepatu::All();

    $listUkuran = [36,37,38,39,40,41,42,43,44,45];
    $listWarna = ['Hitam', 'Putih', 'Merah', 'Biru', 'Abu-abu', 'Coklat'];
@endphp

<div class="col-xl-3 col-lg-4 col-md-5">
    <div class="sidebar-categories">
        <div class="head">Browse Categories</div>
        <ul class="main-categories">
            @forelse ($listCategory as $key=>$category)
                <li class="main-nav-list">
                    <a data-toggle="collapse" href="" aria-expanded="false" aria-controls="">
                        <span class="lnr lnr-arrow-right"></span>
                        <a href="{{ route('product-category', $category->kategori_id) }}">{{ $category->kategori_nama }}</a>
                    </a>
                </li>
            @empty
                <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right">
                </span>No Category Yet</a>
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
                        <input class="pixel-radio" type="checkbox"  name="brand[]" value="{{$supplier->supplier_id}}">
                        <label for="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</label>
                    </li>
                    @empty

                    @endforelse
                </ul>
            </form>
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

            <div class="head">Warna</div>
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
            <button class="primary-btn" type="submit" style="width:100%;text-align:center">Filter</a>
        </form>
    </div>
</div>
