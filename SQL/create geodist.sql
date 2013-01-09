--call geodist(7.3136700000000001, 45.112850000000002, 2, 'id1');

DROP PROCEDURE IF EXISTS geodist;
--show procedure status;

DELIMITER $$
CREATE PROCEDURE geodist(IN mylon double, IN mylat double, IN dist int, IN agencyGlobalId varchar(255))
BEGIN

--declare mylon double; 
--declare mylat double;
declare lon1 float;
declare lon2 float;
declare lat1 float; 
declare lat2 float;

--  earth's radius in the unit of measure you want the results to be. 3956 for miles, 6356 for chilometers
declare rad double;
set rad = 6356;

-- get the original lon and lat for the userid 
--select longitude, latitude 
--into mylon, mylat 
--from users5where id=userid 
--limit 1;

-- calculate lon and lat for the rectangle:
set lon1 = mylon - dist/abs(cos(radians(mylat))*69);
set lon2 = mylon+dist/abs(cos(radians(mylat))*69);
set lat1 = mylat-(dist/69); 
set lat2 = mylat+(dist/69);

-- run the query:
SELECT stop_id, stop_name,
    FORMAT(rad * 2 * ASIN(SQRT( POWER(SIN((mylat - stop_lat) * pi()/180 / 2), 2) +COS(mylat * pi()/180) * COS(stop_lat * pi()/180) *POWER(SIN((mylon - stop_lon) * pi()/180 / 2), 2) )) , 3) as distance 
FROM stops
WHERE
agency_global_id = agencyGlobalId
and stop_lon between lon1 and lon2 
and stop_lat between lat1 and lat2 
having distance < dist 
ORDER BY distance 
limit 10;

END $$
DELIMITER ; 
