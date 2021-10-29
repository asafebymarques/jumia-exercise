{% extends "index.twig.php" %}

{% block content %}
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
{% endblock %}