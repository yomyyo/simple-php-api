<?php

/**
 * Function to query information based on 
 * parameters of start date, end date, and ticker
 *
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try  {
        
        require "../../config.php";

        $connection = new PDO($dsn, $username, $password, $options);

        if($_POST['week']){
            $sql = "SELECT companies.ticker, COUNT(companies.name), historical.d, MAX(historical.high), MIN(historical.low), MAX(historical.close) 
                FROM historical
                LEFT JOIN companies ON companies.company_id=historical.company_id
                WHERE (historical.d BETWEEN :start_date AND :end_date) AND companies.ticker = :ticker
                GROUP BY WEEK(historical.d), historical.d
                UNION 
                SELECT companies.ticker, COUNT(companies.name), historical.d, MAX(historical.high), MIN(historical.low), MAX(historical.close) 
                FROM historical
                RIGHT JOIN companies ON companies.company_id=historical.company_id
                WHERE (historical.d BETWEEN :start_date AND :end_date) AND companies.ticker = :ticker
                GROUP BY WEEK(historical.d), historical.d";
        } else {


            $sql = "SELECT companies.ticker, COUNT(companies.name), historical.d, MAX(historical.high), MIN(historical.low), MAX(historical.close) 
                FROM historical
                LEFT JOIN companies ON companies.company_id=historical.company_id
                WHERE (historical.d BETWEEN :start_date AND :end_date) AND companies.ticker = :ticker
                GROUP BY historical.d
                UNION 
                SELECT companies.ticker, COUNT(companies.name), historical.d, MAX(historical.high), MIN(historical.low), MAX(historical.close) 
                FROM historical
                RIGHT JOIN companies ON companies.company_id=historical.company_id
                WHERE (historical.d BETWEEN :start_date AND :end_date) AND companies.ticker = :ticker
                GROUP BY historical.d";
        }



        $start_date = $_POST['start-date'];
        $end_date = $_POST['end-date'];
        $ticker = $_POST['ticker'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $statement->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $statement->bindParam(':ticker', $ticker, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>