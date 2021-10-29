# Jumia-Exercise

Create a single page application that uses the database provided (SQLite 3) to list and categorize country phone numbers.

Phone numbers should be categorized by country, state (valid or not valid), country code and number.

The page should render a list of all phone numbers available in the DB. It should be possible to filter by country and state. 

**Tests** 

* Test testGetPhone
* Test testPhoneIsValid
* Test testPhoneCode
* Test testGetCountryNameByPhone
* Test testGetRegex
* Test testConnectToDatabase
* Test testGetCustomersFromDB

#### Setup & installation
* composer install
* ./vendor/bin/phpunit tests/
* php -S localhost:8000

### Usage 
* open browser http://localhost:8000/ 
