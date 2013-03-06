SELECT 
    stop_id, 
    stop_name,
    FORMAT(
        6356 * 2 * ASIN(SQRT( POWER(SIN((45.088090 - stop_lat) * pi()/180 / 2), 2) 
        +COS(45.088090 * pi()/180) * COS(stop_lat * pi()/180) 
        *POWER(SIN((7.651969999999999 - stop_lon) * pi()/180 / 2), 2) )) , 3) 
    as distance,
    LEFT (stop_name,1) as k,
    stop_lat, 
    stop_lon
FROM 
    stops
WHERE
    agency_global_id = 'id1'
ORDER BY stop_name
LIMIT 100;