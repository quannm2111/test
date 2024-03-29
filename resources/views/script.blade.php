<script>

    $(document).ready(function () {
        var currentStep = 1;
        var lastStep = $('.form-section').length - 1;

        $('.nextBtn').click(function () {
            switch (currentStep) {
                case 1:
                    if (validateForm1()) {
                        nextStep();
                        getRestaurant();
                    }
                    break;
                case 2:
                    if (validateForm2()) {
                        nextStep();
                        getDishes();
                    }
                    break;
                case 3:
                    if (validateForm3()) {
                        nextStep();
                        getReview();
                    }
                    break;
                default:
                    break;
            }
        });

        $('.prevBtn').click(function () {
            prevStep();
        });

        $('.addBtn').click(function() {
            addNewDishForm();
        });

        function nextStep() {
            $('.step-' + currentStep).hide();
            currentStep++;
            $('.step-' + currentStep).show();
            $('.prevBtn').show();
            if (currentStep === lastStep + 1) {
                $('.submitBtn').show();
                $('.nextBtn').hide();
            }
        }

        function prevStep() {
            $('.step-' + currentStep).hide();
            currentStep--;
            $('.step-' + currentStep).show();
            if (currentStep === 1) {
                $('.prevBtn').hide();
            } else {
                $('.submitBtn').hide();
                $('.nextBtn').show();
            }
        }

        function addNewDishForm() {
            var length = $('#order_dish').find('.order_dish_form').length;
            if (length > 10) 
                return;
            var clonedDiv = $('#order_dish_form').clone();
            var newID = 'order_dish_form_' + (length + 1);
            clonedDiv.attr('id', newID);
            clonedDiv.find('input').val(null);
            $('#order_dish').append(clonedDiv);
        }
    });

    function validateForm1() {
        var meal = $('select[name="meal"] option:selected').val();
        var numOfPeople = $("input[name=num_people]").val();
        $('.meal_error, .num_people_error').empty();

        if (isEmptyOrNaN(meal)) {
            $('.meal_error').text("This field is required.");
            return false;
        }

        if (isEmptyOrNaN(numOfPeople) || numOfPeople > 10) {
            $('.num_people_error').text("This field is required and less than 10.");
            return false;
        }
        return true;
    }

    function validateForm2() {
        var restaurant = $('select[name="restaurant"] option:selected').val();
        if (isEmptyOrNaN(restaurant)) {
            $('.restaurant_error').text("This field is required");
            return false;
        }
        var firstDiv = $(".order_dish_form").first();
        firstDiv.find('input').val(null);
        $(".order_dish_form").not(firstDiv).remove();
        return true;
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
        });
        if (count < numOfPeople) {
            isValid = false;
            $('.dishes_error').text('Dishes cannot be the same. The total number of dishes should be greater or equal to the number of people selected in the first step');
            return isValid;
        }
        return isValid;
    }

    function isEmptyOrNaN(value) {
        return value === null || value === '';
    }

    function getRestaurant() {
        var selectedMeal = $('select[name="meal"] option:selected').val();
        var restaurants = [];
        var option = null;
        var data = {!! json_encode($data) !!};
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

    function getDishes() {
        var selectedRestaurant = $('select[name="restaurant"] option:selected').val();
        var option = null;
        var dishes = [];
        var data = {!! json_encode($data) !!};
        $('select[name="dishes[]"]').empty();
        data.forEach(function(dish) {
            if (dish.restaurant == selectedRestaurant) {
                dishes.push(dish.name);
                option += "<option value='" + dish.id + "'>" + dish.name + "</option>";
            }
        });
        $('select[name="dishes[]"]').html(option);
    }

    function getReview() {
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
</script>