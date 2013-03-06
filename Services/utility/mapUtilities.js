function getFor(type,what){
                // Walk, Bus, Subway, Tram, Finish
                var icons = {
                    W:"http://maps.google.com/mapfiles/marker_grey.png"
                    ,B:"http://maps.google.com/mapfiles/marker_black.png"
                    ,S:"http://maps.google.com/mapfiles/marker_black.png"
                    ,T:"http://maps.google.com/mapfiles/marker_black.png"
                    ,F:"http://maps.google.com/mapfiles/marker_green.png"
                    ,def:"http://maps.google.com/mapfiles/marker_black.png"
                }; 
                
                var cols = {
                    W:"red"
                    ,B:"orange"
                };
                
                var ret;
                
                switch(what){
                    case "icon":
                        ret = icons;
                        break;
                    case "color":
                        ret = cols;
                        break;
                }
                
                return ret[type];
                
            }
            
            function getMarker(lat, lon, type){
                 
                return new google.maps.Marker({
                    position: new google.maps.LatLng(lat,lon)
                    //,map: map
                    //,title:title
                    ,icon: getFor(type,"icon")
                });
                
                /*
                 * Numbered marker: http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=7|FF0000|000000
                 * Text marker: http://chart.apis.google.com/chart?chst=d_map_spin&chld=1|0|FF0000|12|_|foo
                 */
            } 
            
            function getPath(encodedPath, type){
                var decodedPath = google.maps.geometry.encoding.decodePath(encodedPath); 
                                
                return new google.maps.Polyline({
                    path: decodedPath
                    //levels: decodedLevels,
                    ,strokeColor: getFor(type,"color")
                    ,strokeOpacity: 1.0
                    ,strokeWeight: 2
                });
            }
            
            google.maps.Polyline.prototype.getBounds = function() {
                var bo = new google.maps.LatLngBounds();
                this.getPath().forEach(function(e) {
                    bo = bo.extend(e);
                });
                return bo;
            };


