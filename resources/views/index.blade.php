<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center m-auto">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Form</div>

                <div class="card-body">
                    <form id="" method="POST" action="/submit">
                        @csrf
                        <div class="step-1 form-section">
                            <div class="form-group">
                                <label for="meal">Please Select A Meal</label>
                                <select class="form-control" id="meal" name="meal">
                                    <option value="">--Option--</option>
                                    <option value="breakfast">Breakfast</option>
                                    <option value="lunch">Lunch</option>
                                    <option value="dinner">Dinner</option>
                                </select>
                                <div class="meal_error" style="color: red"></div>
                            </div>
    
                            <div class="form-group">
                                <label for="num_people">Please Enter Number of People</label>
                                <input type="number" class="form-control" id="num_people" name="num_people">
                                <div class="num_people_error" style="color: red"></div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group step-2" style="display: none;">
                                <label for="restaurant">Please Select A Restaurant</label>
                                <select class="form-control" id="restaurant" name="restaurant">
                                    <option value="">--Option--</option>
                                </select>
                                <div class="restaurant_error" style="color: red"></div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group step-3" style="display: none;">
                                <div class="" id="order_dish">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Please Select A Dis
                                        </div>
                                        <div class="col-md-6">
                                            Please Enter No. of Serving
                                        </div>
                                    </div>
                                    <div class="order_dish_form row mt-3" id="order_dish_form">
                                        <div class="col-md-6">
                                            <select class="form-control" name="dishes[]">
                                                <option value="">--Option--</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="no_of_sev[]">
                                        </div>
                                    </div>
                                </div>
                                <div class="dishes_error" style="color: red"
                                ></div>
                                <button type="button" class="btn btn-primary rounded-circle mt-3 addBtn">
                                    +
                                </button>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="form-group step-4" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        Meal
                                    </div>
                                    <div class="col-md-6" id="meal_review">
                                        
                                    </div>
                                    <div class="col-md-6">
                                        No of People
                                    </div>
                                    <div class="col-md-6" id="num_people_review">
                                        
                                    </div>
                                    <div class="col-md-6">
                                        Restaurant
                                    </div>
                                    <div class="col-md-6"  id="restaurant_review">
                                        
                                    </div>
                                    <div class="col-md-6">
                                        Dishes
                                    </div>
                                    <div class="col-md-6" id="dishes_review">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" text-center">
                            <button type="button" class="btn btn-primary prevBtn" style="display: none;">Previous</button>
                            <button type="button" class="btn btn-primary nextBtn">Next</button>
                            <button type="submit" class="btn btn-success submitBtn" style="display: none;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function () {
        var currentStep = 1;
        var lastStep = $('.form-section').length - 1;

        $('.nextBtn').click(function () {
            switch (currentStep) {
                case 1:
                    if(validateForm1()) {
                        $('.step-' + currentStep).hide();
                        currentStep++;
                        $('.step-' + currentStep).show();
                        $('.prevBtn').show();
                        getRestaurant();
                    } else return;
                    break;
                case 2:
                    if(validateForm2()) {
                        $('.step-' + currentStep).hide();
                        currentStep++;
                        $('.step-' + currentStep).show();
                        $('.prevBtn').show();
                        getDishes();
                    } else return;
                    break;
                case 3:
                    if(validateForm3()) {
                        $('.step-' + currentStep).hide();
                        currentStep++;
                        $('.step-' + currentStep).show();
                        $('.prevBtn').show();
                        getReview();
                        $('.submitBtn').show();
                        $('.nextBtn').hide();
                    } else return;
                    break;
                default:
                    break;
            }
        });

        $('.prevBtn').click(function () {
            $('.step-' + currentStep).hide();
            currentStep--;
            $('.step-' + currentStep).show();

            if (currentStep === 1) {
                $('.prevBtn').hide();
            } else {
                $('.submitBtn').hide();
                $('.nextBtn').show();
            }
        });

        $('.addBtn').click(function() {
            var length =  $('#order_dish').find('.order_dish_form').length;
            if (length > 10) 
                return;
            var clonedDiv = $('#order_dish_form').clone();
            var newID = 'order_dish_form_' + (length + 1);
            clonedDiv.attr('id', newID);
            clonedDiv.find('input').val(null);
            $('#order_dish').append(clonedDiv);
        })
    });

    function getReview()
    {
        $('#meal_review').empty().text($('#meal').val());
        $('#num_people_review').empty().text($('#num_people').val());
        $('#restaurant_review').empty().text($('#restaurant').val());
        $("#dishes_review").empty();
        $(".order_dish_form").each(function() {
            var selectedOption = $(this).find("select[name='dishes[]'] option:selected").text();
            var servingCount = $(this).find("input[name='no_of_sev[]']").val();
            var newItem = "<span>" + selectedOption + " - " + servingCount + "</span><br>";
            $("#dishes_review").append(newItem);
        });
    }

    function validateForm1()
    {
        var isValid = true,
            meal = $('select[name="meal"] option:selected').val(),
            numOfPeople = $("input[name=num_people]").val();
        $('.meal_error, .num_people_error').empty();
       
        if (meal == null || meal == '') {
            $('.meal_error').text("This feild is required.");
            isValid = false;
        }

        if (numOfPeople == null || numOfPeople == '' || numOfPeople > 10) {
            $('.num_people_error').text("This feild is required and less than 10.");
            isValid = false;
        }
        return isValid;
    }

    function validateForm2()
    {
        var isValid = true,
            restaurant = $('select[name="restaurant"] option:selected').val();
        
        if (meal == null || meal == '') {
            $('.restaurant_error').text("This feild is required");
            idValid = false;
            return isValid;
        }
        var firstDiv = $(".order_dish_form").first();
        firstDiv.find('input').val(null);
        $(".order_dish_form").not(firstDiv).remove();

        return isValid;
    }

    function validateForm3() 
    {
        var isValid = true,
            selectedOptions = [],
            count = 0,
            numOfPeople = parseInt($("input[name=num_people]").val());
        $('.dishes_error').empty();
        $(".order_dish_form").each(function() {
            var selectedOption = $(this).find("select[name='dishes[]'] option:selected").val();
            var numOfSev = parseInt($(this).find("input[name='no_of_sev[]']").val());
            if (selectedOptions.includes(selectedOption) || isNaN(numOfSev)) {
                isValid = false;
                $('.dishes_error').text('Dishes cannot be the same. The total number of dishes should be greater or equal to the number of people selected in the first step');
                return isValid;
            }
            selectedOptions.push(selectedOption);
            count += parseInt(numOfSev);
            console.log(count, selectedOptions,selectedOptions.includes(selectedOption), isNaN(numOfSev));
        });
        if (count < numOfPeople) {
            isValid = false;
            $('.dishes_error').text('Dishes cannot be the same. The total number of dishes should be greater or equal to the number of people selected in the first step');
            return isValid;
        }
        return isValid;
    }

    function getRestaurant() {
        var selectedMeal = $('select[name="meal"] option:selected').val(),
            restaurants = [],
            option = null,
            data = {!! json_encode($data) !!};
        $('select[name="restaurant"]').empty();

        data.forEach(function(dish) {
            if (dish.availableMeals.includes(selectedMeal)) {
                if (!restaurants.includes(dish.restaurant)) {
                    restaurants.push(dish.restaurant);
                    option += "<option value='" + dish.restaurant + "'>" + dish.restaurant + "</option>";
                }
            }
        });
        $('select[name="restaurant"]').html(option);
    }

    function getDishes()
    {
        var selectedRestaurant = $('select[name="restaurant"] option:selected').val(),
            option = null,
            dishes = [],
            data = {!! json_encode($data) !!};
        $('select[name="dishes[]"]').empty();
        data.forEach(function(dish) {
            if (dish.restaurant == selectedRestaurant) {
                dishes.push(dish.name);
                option += "<option value='" + dish.id + "'>" + dish.name + "</option>";
                
            }
        });
        $('select[name="dishes[]"]').html(option);
    }
</script> --}}
@include('script')
</body>
</html>