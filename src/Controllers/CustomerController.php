<?php

namespace Jumia\Controllers;

use Jumia\Core\Controller;
use Jumia\Helpers\CountryHelper;
use Jumia\Models\Customer;
use Jumia\Services\CustomerService;

class CustomerController extends Controller
{
    /**
     * @return void
     */
    public function index()
    {
        try {
            $dados = [];

            $page = $_GET['page'] ?? 1;
            $dados['page'] = $page;
            $dados['limit'] = Customer::LIMIT;
            $dados['countries'] = CountryHelper::COUNTRIES_LIST;

            $customerService = new CustomerService(new Customer());

            if (isset($_GET['countryCode']) || isset($_GET['state'])) {
                $customers = $customerService->getCustomersWithCriteria([
                        'countryCode' => $_GET['countryCode'] ?? '',
                        'state' => $_GET['state'] ?? '',
                    ], $page);

                $dados['customers'] = $customers;
            } else {
                $customers = $customerService->getCustomers($page);

                $dados['customers'] = $customers;
            }

            $this->load('index', $dados);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
