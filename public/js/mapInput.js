function initialize() {


  var crosshairShape = {
    coords: [0, 0, 0, 0],
    type: 'rect'
  };
  var mapCanvas = document.getElementById('map');
  var mapOptions = {
    //center: new google.maps.LatLng(1.474830, 124.842079),
    center: navigator.geolocation.getCurrentPosition(
        (position= GeolocationPosition) => {
          var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          map.setCenter(pos);
          },
        ),
    zoom: 14,
    scrollwheel: false,
    panControl: false,
    zoomControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);

  var marker = new google.maps.Marker({
    map: map,
    draggable: true
  });
 var geocoder = new google.maps.Geocoder();

//Mentukan kecamtan dan kelurahan
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0]);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerAddress(str) {
   
    let pemula = str;
    let kelurahan = "";
    let kecamatan = "";
  
    for (const component of pemula.address_components) {
     const componentType = component.types[0];
       switch (componentType) {
           case "administrative_area_level_4": {
       			kelurahan = `${component.short_name}${kelurahan}`;
        	 break;
        }
          case "administrative_area_level_3": {
          kecamatan = `${component.long_name}${kecamatan}`;
          break;
        } 
      }
    }
// let text = " ,";
 var kecas = kecamatan.replace(/Kecamatan /g,'');
  //document.getElementById('address').innerHTML = kecas +text+kelurahan;
console.log(kecas);
console.log(kelurahan);

document.getElementById("infokec").innerHTML = kecas;
document.getElementById("infokel").innerHTML = kelurahan;
document.getElementById("dropkec").innerHTML = kecas;
document.getElementById("dropkel").innerHTML = kelurahan;

 $('input[name=infokelurahan]').val(kelurahan);
 $('input[name=infokecamatan]').val(kecas);
  	
}

//Search box
  const input = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(input);
  
    map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
  
searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }


    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    places.forEach((place) => {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }

      /* google.maps.event.addListener(map,'dragend', function (event) {
            marker(this, event.latLng);
      }); */
      
      console.log(place.geometry.location.toJSON()); 

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
        document.getElementById('infolat').value = place.geometry.location.lat();
        document.getElementById('infolng').value = place.geometry.location.lng();
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}



function updateMarkerPosition(latLng) {
  var objlat = JSON.parse(latLng.lat(),);
  var objlng = JSON.parse(latLng.lng(),);
/*   document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ]; */
document.getElementById("infolat").innerHTML = objlat;
document.getElementById("infolng").innerHTML = objlng;
  console.log(latLng.toJSON());
 
 $('input[name=infolat]').val(objlat);
 $('input[name=infolng]').val(objlng);
  
}
/* Newlat.push(UpdateMarkerPosition); */


  marker.bindTo('position', map, 'center');
  //marker.bindTo('position', map, 'center');
 

  map.addListener('dragend', function() {
    var Newlat = map.getCenter().toJSON();
    console.log(Newlat);
  });

  

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
    
  });
   map.addListener("bounds_changed", () => {
    geocodePosition(marker.getPosition());
  });
  google.maps.event.addListener(map, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(map.getCenter());
    
  });
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragstart', function() {
    geocodePosition(marker.getPosition());
  });
  
  google.maps.event.addListener(map, 'dragstart', function() {
    geocodePosition(marker.getPosition());
  });

//tambahan melakukan pencarian koordinat dengan  HTML5 Geolocation (gps)
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          marker.setPosition(pos);
          map.setCenter(pos);
          
/*           const gpslat = marker.getCenter(pos).toJSON(); */
    			console.log(pos);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }

};
google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, "load", initialize);








 

