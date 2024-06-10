@extends('layout.main')
@php
	use App\Models\sepatu;
    use App\Models\DetailSepatu;
@endphp
@section('content')

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Cart</a>
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
                                <th class="flex-fill">Product</th>
                                <th class="col-2">Price</th>
                                <th class="col-2">Quantity</th>
                                <th class="col-2">Total</th>
                            </tr>
                        </thead>
                        {{-- @dd($cartSepatu) --}}
                        <tbody>
                            @php
                                $subtotalProducts = 0;
                            @endphp
                            @forelse ($cartSepatu as $c)
                                @php
                                    $sepatu = DetailSepatu::find($c['detail_id']);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex col-4">
                                                @if ($sepatu->detail_sepatu_pict != null)
                                                    <img class="img-fluid" src="{{ Storage::url("photo/$sepatu->detail_sepatu_pict") }}" alt="">
                                                @endif
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $sepatu->sepatu->sepatu_name }}</h4>
                                                <h5>Size : {{ $sepatu->detail_sepatu_ukuran }}</h4>
                                                <h5>Color : {{ $sepatu->detail_sepatu_warna }}</h4>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>{{ formatCurrencyIDR($sepatu->detail_sepatu_harga) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="qty" id="sst" maxlength="12" value="{{ $c['qty'] }}" title="Quantity:"
                                                class="input-text qty">
                                            <button class="increase items-count" type="button"><a href="{{ route('increase-cart-qty', $c['detail_id']) }}"><i class="lnr lnr-chevron-up"></i></a></button>
                                            <button class="reduced items-count" type="button"><a href="{{ route('reduced-cart-qty', $c['detail_id']) }}"><i class="lnr lnr-chevron-down"></i></a></button>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                             $total = $sepatu->detail_sepatu_harga * $c['qty'];
                                            $subtotalProducts += $total;
                                        @endphp
                                        <h5>{{ formatCurrencyIDR($total) }}</h5>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Your cart is empty!</td>
                                </tr>
                            @endforelse

                            <tr>
                                <td colspan="2"></td>
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h4>{{ formatCurrencyIDR($subtotalProducts) }}</h4>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="login_form_inner ">
                                                    <h3 class="mb-2">Shipping</h3>
                                                    <p class="col-md-12 px-3 mb-4">
                                                        Produk akan dikirim dari: <br>
                                                        Jl. Basuki Rahmat No.8-12, Kedungdoro, Tegalsari,<br>
                                                        Surabaya, East Java 60261
                                                    </p>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" class="form-control" id="address" name="address" autocomplete="off" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" class="form-control" id="city" name="city" autocomplete="off" placeholder="City Destination" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City Destination'">
                                                        <ul class="dropdown-menu" id="suggestions_city" style="display: none; margin-top: -25px; margin-left: 15px;"></ul>
                                                        <br><span style="color: red;">{{ $errors->first('city') }}</span>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <button type="submit" value="submit" class="genric-btn info circle mt-3 mb-5" id="calculate">CALCULATE</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="login_form_inner ">
                                                    <h2 style="color: #e29255">ETD</h2>
                                                    <h3 style="color: #e29255" id="etd">- Days</h3>
                                                    <h2 style="color: #6f7588">PRICE</h2>
                                                    <h3 style="color: #6f7588" id="price">Rp 0</h3>
                                                    <div class="col-12 form-group px-5">
                                                        <h3>Select Service</h3>
                                                        <div class="switch-wrap d-flex justify-content-between" id="service"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="out_button_area">
                                <td colspan="4"></td>
                                <td>
                                    <form action="{{ route('checkout-process') }}" method="POST">
                                        @csrf
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <a class="gray_btn" style="padding: 0px 13px" href="/products">Continue Shopping</a>
                                            <input type="hidden" id="shipping-description" name="shipping-description" value="service">
                                            <input type="hidden" id="shipping-price" name="shipping-price" value="0">
                                            @if ($cartSepatu != NULL)
                                                <button class="btn primary-btn">Checkout</button>
                                            @else
                                                <button class="btn primary-btn" disabled>Checkout</button>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!--================End Cart Area =================-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        const etd = document.getElementById("etd");
        const price = document.getElementById("price");
        const selectService = document.getElementById("service");

        // INPUT CITIES
        const suggestions_city = {{ Js::from($cities) }};
        const inputCity = document.getElementById("city");
        const suggestionList_city = document.getElementById("suggestions_city");

        document.addEventListener("click", function(event) {
            if (!suggestionList_city.contains(event.target) && event.target !== inputCity) {
                suggestionList_city.style.display = "none";
            }
        });

        function handleInputCity(event) {
            const inputValue = event.target.value.toLowerCase();
            const filteredSuggestions = suggestions_city.filter(suggestion =>
                suggestion.city_name.toLowerCase().startsWith(inputValue)
            );
            // Clear previous suggestions and rebuild the list
            suggestionList_city.innerHTML = "";
            for (const suggestion of filteredSuggestions) {
                const listItem = document.createElement("li");
                listItem.textContent = suggestion.city_name;
                listItem.value = suggestion.city_id
                listItem.className = 'px-3'
                suggestionList_city.appendChild(listItem);
            }
            // Show or hide the suggestion list based on results
            if (filteredSuggestions.length > 0) {
                suggestionList_city.style.display = "block"; // Show the list
            } else {
                suggestionList_city.style.display = "none"; // Hide the list
            }
        }
        inputCity.addEventListener("input", handleInputCity);

        function handleSelectionCity(event) {
            // Get the clicked list item element
            const clickedItem = event.target;

            // Check if the clicked element is a list item (LI)
            if (clickedItem.tagName === "LI") {
                // Access the city ID stored in the list item's value
                const selectedCityId = clickedItem.value;

                // (Optional) Update the input field with the selected city name (can be commented out if not desired)
                inputCity.value = clickedItem.textContent;
                suggestionList_city.style.display = "none"; // Hide the list

                // Use the selectedCityId for further actions (e.g., display additional information, submit a form)
                localStorage.setItem("cityID", selectedCityId); // Save CityID to localstorage
                console.log("Selected city ID:", selectedCityId); // Example usage
            }
        }
        suggestionList_city.addEventListener("click", handleSelectionCity);

        // IDR CONVERTER
        function formatCurrencyIDR(amount) {
            // Fix number of decimals and round if necessary
            amount = Math.round(amount * 100) / 100;

            // Separate integer and decimal parts
            const parts = amount.toString().split('.');

            // Format integer part with commas for thousands
            let integerPart = parts[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');

            // Handle decimals (if any)
            const decimalPart = parts.length > 1 ? `.${parts[1].slice(0, 2)}` : ''; // Limit to 2 decimals

            // Combine and return formatted string
            return `Rp ${integerPart}${decimalPart}`;
        }

        // INITIALIZE CHECKED RADIO BUTTON
        function initializeService() {
            const radioButtons = document.querySelectorAll('input[type="radio"][name="radioOption"]');
            radioButtons[0].checked = true; // Select the second radio button

            var data = JSON.parse(localStorage.getItem("list-cost"));
            etd.innerHTML = data[0]['cost'][0]['etd'] + ' DAY';
            price.innerHTML = formatCurrencyIDR(data[0]['cost'][0]['value']);

            const descriptionInput = document.getElementById("shipping-description");
            descriptionInput.value = data[0]['description'];
            const costInput = document.getElementById("shipping-price");
            costInput.value = data[0]['cost'][0]['value'];
        }

        // CALCULATE COST
        $('#calculate').on('click', function() {
            var cityID = localStorage.getItem('cityID');

            $.ajax({
                url: '/calculate-shipping/' + cityID,
                success: function(data) {
                    localStorage.setItem("list-cost", JSON.stringify(data));
                    selectService.innerHTML = "" // Clear existing options
                    $.each(data, function(key, cost) {
                        var text = document.createElement('p');
                        text.textContent = cost.description;

                        var newRadio = document.createElement('input');
                        newRadio.type = 'radio';
                        newRadio.name = 'radioOption';
                        newRadio.id = 'radio' + key;
                        newRadio.value = key;

                        var label = document.createElement('label');
                        label.id = 'label' + key;

                        var container = document.createElement('div');
                        container.className = 'primary-radio';
                        container.appendChild(newRadio);
                        container.appendChild(label);

                        var parentElement = document.getElementById('service');
                        parentElement.appendChild(container);
                        parentElement.appendChild(text);

                        var setLabel = document.getElementById('label' + key);
                        setLabel.setAttribute('for', 'radio' + key);
                    });
                    initializeService();
                }
            });
        });

        // DYNAMICALLY CHANGE ETD AND COST BASED ON SERVICE
        $('#service').on('change', function() {
            // Access the selected radio button using event.target
            var selectedRadio = event.target;

            if (selectedRadio.checked) {
                console.log('Radio button with value ' + selectedRadio.value + ' is selected!');
                // You can add further logic here based on the selected radio button's value.

                var data = JSON.parse(localStorage.getItem("list-cost"));
                etd.innerHTML = data[selectedRadio.value]['cost'][0]['etd'] + ' DAY';
                price.innerHTML = formatCurrencyIDR(data[selectedRadio.value]['cost'][0]['value']);

                const descriptionInput = document.getElementById("shipping-description");
                descriptionInput.value = data[selectedRadio.value]['description'];
                const costInput = document.getElementById("shipping-price");
                costInput.value = data[selectedRadio.value]['cost'][0]['value'];
            }
        });
    </script>
@endsection
