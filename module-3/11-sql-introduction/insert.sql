/*
    INSERT allows us to add records to a table

    INSERT INTO cities (col_1, col_2, col_3) VALUES (
        (value_1, value_2, value_3)
    )
*/

-- Lets enter a new city into our database, one with 2 exclamation points

INSERT INTO cities (`city_name`, `province`, `population`, `is_capital`, `trivia`) VALUES (
    ('Saint-Louis-du-Ha! Ha!', 'QC', 1311, FALSE, 'this is totally trivia about a dumb city name ha HA!')
);

INSERT INTO cities (`city_name`, `province`, `population`, `is_capital`, `trivia`) VALUES 
    ('Happy Adventure', 'NL', 118, FALSE, NULL),
    ('Flin Flon', 'MB', 18292, FALSE, NULL),
    ('Vulcan', 'AB', 17236, FALSE, 'This is STAR TREK CITY... bitch'),
    ('Value Village', 'AB', 459, FALSE, 'THIS BITCH EMPTY')