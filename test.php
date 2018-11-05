<?php
$names = ['Emma', 'William', 'Sofia', 'Oliver', 'Henry'];
$last_Name = ['Nelson', 'Ross', 'Cox', 'Lopez', 'Perez'];
$emails = ['Emma_Nelson@gmail.com', 'William_Ross@yahoo.com', 'Sofia_Cox@yandex.com', 'Oliver_Lopez@default-value.com.', 'Henry_Perez@hotmail.com'];

/**
 * @param $array
 * @param $num
 * @return mixed
 */

function getRandomEl($array, $num)
{

    return $array[mt_rand(0, $num)];
//        $rand_keys = array_rand($array, 1);
//       return $array[$rand_keys[0]];
}

/**
 * @param $num
 * @param $names
 * @param $last_Name
 * @param $emails
 * @return int
 */

function generateCustomers($num, $names, $last_Name, $emails)
{
    $customers = [];

    for ($i = 0; $i < $num; $i++) {
        $userName = getRandomEl($names, $num) . ' ' . getRandomEl($last_Name, $num) . ' ' . getRandomEl($emails, $num);
        /** @var TYPE_NAME $userName */
        $customers[$i]['firstname'] = $userName;
//        array_push($customers, $userName);
    }
    return $customers;
}


$userName = generateCustomers(100, $names, $last_Name, $emails);



var_dump($userName);