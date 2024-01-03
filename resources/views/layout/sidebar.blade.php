@php
    use App\Models\kategori;
    use App\Models\supplier;
    use App\Models\ukuran;
	$userLoggedIn = Session::get('userLoggedIn');
    $listCategory = kategori::All();
    $listSupplier = supplier::All();
    $listUkuran = ukuran::All();
@endphp

<div class="col-xl-3 col-lg-4 col-md-5">
    <div class="sidebar-categories">
        <div class="head">Browse Categories</div>
        <ul class="main-categories">
            @forelse ($listCategory as $key=>$category)
                <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right">
                </span>{{ $category->kategori_nama }}</a>
                </li>
            @empty
                <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right">
                </span>No Category Yet</a>
                </li>
            @endforelse
        </ul>
    </div>
    <div class="sidebar-filter mt-50">
        <div class="top-filter-head">Product Filters</div>
        <div class="common-filter">
            <div class="head">Brands</div>
            <form action="#">
                <ul>
                    @forelse ($listSupplier as $key=>$supplier)
                    <li class="filter-list"><input class="pixel-radio" type="radio" id="{{$supplier->supplier_id}}" name="{{$supplier->supplier_name}}"><label for="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</label></li>
                    @empty

                    @endforelse
                </ul>
            </form>
        </div>
        <div class="common-filter">
            <div class="head">Size</div>
            <form action="#">
                <ul>
                    @forelse ($listUkuran as $key=>$ukuran)
                    <li class="filter-list"><input class="pixel-radio" type="radio" id="{{ $ukuran->ukuran_sepatu_nama }}" name="{{ $ukuran->ukuran_sepatu_nama }}"><label for="{{ $ukuran->ukuran_sepatu_nama }}">{{ $ukuran->ukuran_sepatu_nama }}</label></li>
                    @empty

                    @endforelse
                </ul>
            </form>
        </div>
    </div>
</div>
