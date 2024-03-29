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
@include('script')
</body>
</html>