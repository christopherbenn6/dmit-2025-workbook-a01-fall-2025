/*
    SELECT column_name FROM table_name WHERE condition;
*/

SELECT city_name 
FROM cities;

SELECT * FROM cities LIMIT 3;

SELECT `population`
FROM cities
WHERE `population` > 1000000;

SELECT * 
FROM cities 
WHERE city_name LIKE '%john%'
-- % means anything before or after, all we require is john to be somewhere in string
-- _ works like % but only for a single character

SELECT * 
FROM cities 
WHERE `population` > 1000000 
    AND `province` = 'AB'

SELECT `city_name`, `population`
FROM cities
WHERE `population` > 500000
ORDER BY `population` DESC;

SELECT `city_name`, `population`
FROM cities
ORDER BY `population` ASC LIMIT 1, 3
--limit 1, 3 offsets by 1
--This query avoids the first, then limits to 3 after that

--Villages 
SELECT `city_name`
FROM cities
WHERE `population` BETWEEN 300 AND 999