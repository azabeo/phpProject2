SELECT 
    stop_id, 
    stop_name,
    FORMAT(
        ? * 2 * ASIN(SQRT( POWER(SIN((? - stop_lat) * pi()/180 / 2), 2) 
        +COS(? * pi()/180) * COS(stop_lat * pi()/180) 
        *POWER(SIN((? - stop_lon) * pi()/180 / 2), 2) )) , 3) 
    as distance,
    stop_lat, 
    stop_lon
FROM 
    stops
WHERE
    agency_global_id = ?
    and stop_lon between ? and ? 
    and stop_lat between ? and ? 
HAVING distance < ?
ORDER BY distance
LIMIT ?;

rad, mylat, mylat, mylon, agencyGlobalId, lon1, lon2, lat1, lat2, dist, lim