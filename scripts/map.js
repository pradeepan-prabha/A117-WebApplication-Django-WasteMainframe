function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(13.863276, 81.207977),
      zoom: 3
    });
    var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP or XML file
      downloadUrl('http://localhost/zero-waste-city/dbconnect/convertToXML.php', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var id = markerElem.getAttribute('id');
          var country = markerElem.getAttribute('country');
          var rawImg =  "https://images.unian.net/photos/2019_06/1561366441-2253.JPG?0.6219850427779223";
          var detectedImg =  "https://images.unian.net/photos/2019_06/1561366441-2253.JPG?0.6219850427779223";
            var state = markerElem.getAttribute('state');
            var district = markerElem.getAttribute('district');
            var region = markerElem.getAttribute('region');
            var city = markerElem.getAttribute('city');
            var street = markerElem.getAttribute('street');
            var pincode = markerElem.getAttribute('pincode');
            var waste_type = markerElem.getAttribute('waste_type');
            var waste_char = markerElem.getAttribute('waste_char');
            var waste_status = markerElem.getAttribute('waste_status');
            var waste_shape = markerElem.getAttribute('waste_shape');
            var loc_type = markerElem.getAttribute('loc_type');
          var type = markerElem.getAttribute('type');
          var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('lat')),
              parseFloat(markerElem.getAttribute('lng')));
          var imgSize = 180;  
          var infowincontent = document.createElement('div');
          var strong = document.createElement('div');
          strong.innerHTML = `<div style="display: flex; justify-content: space-between; font-size: 15px;">
                              <div style="padding-right: 20px; display: flex;">
                              <figure>
                              <img src="${rawImg}" width="${imgSize}" height="${imgSize}">
                              <figcaption>Raw Image</figcaption>
                              </figure>
                              <figure>
                              <img src="${detectedImg}" width="${imgSize}" height="${imgSize}">
                              <figcaption>Detected Image</figcaption>
                              </figure>
                              </div>
                              <div>
                              <p><strong>Waste:</strong> ${waste_type}</p>
                              <p><strong>Location:</strong> ${loc_type}</p>   
                              <p><strong>Shape:</strong> ${waste_shape}</p>
                              <p><strong>Characteristics:</strong> ${waste_char}</p>
                              <p><strong>Status:</strong> ${waste_status}</p>
                              </div>
                              </div>`;
          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var text = document.createElement('p');
          text.innerHTML = `<strong>Address:</strong> ${street}, ${pincode}, ${city}, ${region}, ${district}, ${state}, ${country}`;
          infowincontent.appendChild(text);
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            // label: icon.label
          });
          marker.addListener('click', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });
        });
      });
    }



  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing(){ }
