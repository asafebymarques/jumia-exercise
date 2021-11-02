<?php

declare(strict_types=1);

namespace Jumia\Services;

use Jumia\Models\Customer;
use Jumia\Models\Phone;

class CustomerService implements CustomerServiceInterface
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getCustomers(string $page): array
    {
        $customers = [];

        $phones = $this->customer::getCustomersPhones($page);

        foreach ($phones as $value) {
            $phone = new Phone($value);
            $phone->setCountryCode();

            $customer['phone'] = $phone->getPhone();
            $customer['countryCode'] = $phone->getCountryCode();
            $customer['valid'] = $phone->isValid();
            $customer['countryName'] = $phone->getCountryNameByCode();

            array_push($customers, $customer);
        }

        return $customers;
    }

    public function getCustomersWithCriteria(string $countryCode, string $state, string $page): array
    {
        $customers = [];
        $phones = [];
        
        if(!empty($countryCode) && !empty($state)){
            $phones = $this->customer::getCustomerByCountryCodeAndState($countryCode, $state, $page);
        } else if (!empty($countryCode)) {
            $phones = $this->customer::getCustomerByCountryCode($countryCode, $page);
        } else if (!empty($state)) {
            $phones = $this->customer::getCustomerByState($state, $page);
        } else {
            $phones = $this->customer::getCustomersPhones($page);
        }

        foreach ($phones as $value) {
            $phone = new Phone($value);
            $phone->setCountryCode();

            $customer['phone'] = $phone->getPhone();
            $customer['countryCode'] = $phone->getCountryCode();
            $customer['valid'] = $phone->isValid();
            $customer['countryName'] = $phone->getCountryNameByCode();

            array_push($customers, $customer);
        }

        return $customers;
    }
}
