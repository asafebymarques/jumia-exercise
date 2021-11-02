<?php

namespace Jumia\Models;

use Jumia\Database\SQLiteConnection;
use Jumia\Helpers\CountryHelper;

class Customer
{
    const TABLE = 'customer';
    const LIMIT = 10;

    public static function getCustomersPhones(string $page): array
    {
        $customers = [];

        $pdo = (new SQLiteConnection())->connect();

        $offset = ($page - 1) * self::LIMIT;

        $sql = 'SELECT phone FROM customer LIMIT :offset, :limit';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':offset', $offset);
        $sql->bindValue(':limit', self::LIMIT);
        $sql->execute();

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = $row['phone'];
        }

        return $customers;
    }

    public static function getCustomerByState(string $state, string $page): array 
    {
        $customers = [];

        $pdo = (new SQLiteConnection())->connect();

        $offset = ($page - 1) * self::LIMIT;
        $stateRegex = "/".implode('|', array_column(CountryHelper::COUNTRIES_LIST, 'regex'))."/";


        if($state === 'nok') {
            $sql = 'SELECT phone FROM customer WHERE NOT regexp_like(:state, phone) LIMIT :offset, :limit';

        } else {
            $sql = 'SELECT phone FROM customer WHERE regexp_like(:state, phone) LIMIT :offset, :limit';
        }
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':state', $stateRegex);
        $sql->bindValue(':offset', $offset);
        $sql->bindValue(':limit', self::LIMIT);
        $sql->execute();

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = $row['phone'];
        }

        return $customers;
    }

    public static function getCustomerByCountryCode(string $countryCode, string $page): array
    {
        $customers = [];

        $pdo = (new SQLiteConnection())->connect();

        $offset = ($page - 1) * self::LIMIT;
        $countryRegex = "/\($countryCode\)/";

        $sql = 'SELECT phone FROM customer WHERE regexp_like(:countryCode, phone) LIMIT :offset, :limit';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':countryCode', $countryRegex);
        $sql->bindValue(':offset', $offset);
        $sql->bindValue(':limit', self::LIMIT);
        $sql->execute();

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = $row['phone'];
        }

        return $customers;
    }

    public static function getCustomerByCountryCodeAndState(string $countryCode, string $state, string $page): array
    {
        $customers = [];

        $pdo = (new SQLiteConnection())->connect();

        $offset = ($page - 1) * self::LIMIT;
        $countryRegex = "/\($countryCode\)/";
        $stateRegex = "/".CountryHelper::COUNTRIES_LIST[$countryCode]['regex']."/";


        if($state === 'nok') {
            $sql = 'SELECT phone FROM customer WHERE regexp_like(:countryCode, phone) AND NOT regexp_like(:state, phone) LIMIT :offset, :limit';

        } else {
            $sql = 'SELECT phone FROM customer WHERE regexp_like(:countryCode, phone) AND regexp_like(:state, phone) LIMIT :offset, :limit';
        }
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':countryCode', $countryRegex);
        $sql->bindValue(':state', $stateRegex);
        $sql->bindValue(':offset', $offset);
        $sql->bindValue(':limit', self::LIMIT);
        $sql->execute();

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = $row['phone'];
        }

        return $customers;
    }
}
