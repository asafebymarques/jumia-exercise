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
        $sql->bindValue('offset', $offset);
        $sql->bindValue('limit', self::LIMIT);
        $sql->execute();

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = $row['phone'];
        }

        return $customers;
    }

    public static function getCustomerPhoneByCriteria(array $searchCriteria, string $page): array
    {
        $isFilteredByCode = false;

        $customers = [];

        $pdo = (new SQLiteConnection())->connect();

        $queryParts[] = 'SELECT * FROM customer';

        if ($searchCriteria['countryCode']) {
            $isFilteredByCode = true;
            $queryParts[] = "WHERE regexp_like('/\({$searchCriteria['countryCode']}\)/', phone)";
        }

        if ($searchCriteria['state']) {
            $queryParts[] = $isFilteredByCode ? 'AND' : 'WHERE';
            $regex = $isFilteredByCode ? CountryHelper::COUNTRIES_LIST[$searchCriteria['countryCode']]['regex']
                : implode('|', array_column(CountryHelper::COUNTRIES_LIST, 'regex'));

            $queryParts[] = $searchCriteria['state'] === 'nok' ? 'NOT' : '';
            $queryParts[] = "regexp_like('/{$regex}/', phone)";
        }

        $offset = ($page - 1) * self::LIMIT;
        $queryParts[] = ' LIMIT '.$offset.','.self::LIMIT;

        $sql = implode(' ', $queryParts);
        $sql = $pdo->prepare($sql);
        $sql->execute();

        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = $row['phone'];
        }

        return $customers;
    }
}
