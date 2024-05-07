@extends('layout.main')

@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shipping</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Shipping</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_form_inner ">
						<h3>Shipping</h3>
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
                        <a class="primary-btn mb-4" style="display: none" id="confirm" href="">Confirm</a>
					</div>
				</div>
			</div>
		</div>
	</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        const etd = document.getElementById("etd");
        const price = document.getElementById("price");
        const confirm = document.getElementById("confirm");
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
                    confirm.style.display = "";
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
            }
        });
    </script>
@endsection
