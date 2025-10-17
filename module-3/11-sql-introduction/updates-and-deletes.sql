/*
    UPDATE table_name
    SET column1 = value1, column_2 = value2 ...
    WHERE condition
*/

UPDATE cities
SET `city_name` = 'Torano'
WHERE cid = 1;

UPDATE cities
SET `population` = `population` + 1000
WHERE province = 'AB' OR province = 'SK'

/*
    DELETE FROM table_name
    WHERE condition
*/

DELETE FROM cities
WHERE cid = 16

-- We will remove non cities (pop < 10,000)

DELETE FROM cities
WHERE `population` < 10000