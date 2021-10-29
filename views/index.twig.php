<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia Exercise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <div class="container-fluid">   
            <div class= "container">
                <center><h1>Phone List</h1></center>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Select Country</label>
                            <div class="col-sm-8">
                                <select class="form-control country-filter" name="country">
                                <option value="">Select country</option>             
                                {% for code, country in countries %}
                                    <option value="{{code}}">{{country.name}}</option>
                                {% endfor %}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Phone State</label>
                            <div class="col-sm-8">
                                <select class="form-control state-filter" name="state">
                                    <option value="">Select state</option>
                                    <option value="nok">NOK</option>
                                    <option value="ok">OK</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row customer" id="customer">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Country</th>
                                <th scope="col">State</th>
                                <th scope="col">Country code</th>
                                <th scope="col">Phone number</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {% for customer in customers %}
                            <tr>
                                <td>{{customer.countryName}}</td>
                                <td>{{customer.valid}}</td>
                                <td>{{customer.countryCode}}</td>
                                <td>{{customer.phone}}</td>
                            </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                                
                    <div class="row">
                        {% if page > 1 %}
                            <div class="col">
                                <button type="button" class="btn btn-light prev" data-page="{{page - 1}}">< Prev</button>
                            </div>
                        {% endif %}
                        {% if customers|length == limit %}
                            <div class="col">
                                <button type="button" class="btn btn-light next" data-page="{{page + 1}}">Next ></button>
                            </div>
                        {% endif %} 
                    </div>
                </div>       
            </div>        
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script>
			$('.country-filter, .state-filter').change(function(){
				$.ajax({
					url: "",
					type: 'get',
					data: {
						countryCode: $('.country-filter').val(),
						state: $('.state-filter').val(),
						page: $(this).data('page'),
					},
					success: function (data) {
						$('#customer').html(data);
					}
				});
			})

			$(document).on('click', '.next, .prev', function(){
				$.ajax({
					url: "",
					type: 'get',
					data: {
						page: $(this).data('page'),
						countryCode: $('.country-filter').val(),
						state: $('.state-filter').val()
					},
					success: function (data) {
						$('#customer').html(data);
					}
				});
			})
		</script>
</body>
</html>