@extends('layout.main')
@php
	use App\Models\sepatu;
    use App\Models\DetailSepatu;

    $listSepatu = sepatu::All();
@endphp
@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Wishlist</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Wishlist</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="flex-fill">Wishlist Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($listWishlist) --}}
                        @forelse ($listWishlist as $c)
                            <tr>
                                <td>
                                    <a href="{{ route('product-detail', $c->fk_sepatu) }}">
                                        <div class="media">
                                            <div class="d-flex col-4">
                                                {{-- <img class="img-fluid" src="{{ Storage::url("photo/$c->shoe->details->detail_sepatu_pict") }}" alt=""> --}}
                                                @php
                                                    $sepatu = DetailSepatu::where('fk_sepatu','=',$c->fk_sepatu)->get()
                                                    // $g = $sepatu[0]->detail_sepatu_pict
                                                @endphp
                                                <img class="img-fluid" src="{{ Storage::url("photo/$sepatu[0]->detail_sepatu_pict") }}" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $c->shoe->sepatu_name }}</h4>
                                                {{-- <h4>{{ $c->sepati }}</h4> --}}
                                            </div>
                                        </div>
                                    </a>
                               </td>
                               <td></td><td></td><td></td>
                               <td>
                                    <form action="{{ route('remove-from-wishlist') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="url" value="{{  URL::current()  }}">
                                        <input type="hidden" name="sepatu_id" value="{{  $c->fk_sepatu  }}">
                                        <button type="submit" class="like" style="height: fit-content; width: fit-content; background-color: #ffffff00; border: 0px">
                                        {{-- <button class="like"> --}}
                                            <i class="fa-solid fa-heart fa-2x" style="color: #ffa600;  cursor: pointer"></i>
                                        {{-- </button>     --}}
                                        </button>
                                    </form>
                               </td>
                            </tr>                    
                        @empty
                            <tr>
                                <td colspan="4">Your Wishlist is empty!</td>
                            </tr>
                        @endforelse
                        
                            <tr class="out_button_area">
                                <td colspan="4"></td>
                                <td>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

@endsection
