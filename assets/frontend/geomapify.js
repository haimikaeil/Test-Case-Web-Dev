/**
 * *******************************************************
 * geomapify - Ultimate library for google maps autocomplete
 * version: 1.0
 * Coded by ADFDEV - https://adfdev.it/
 * GitHub: https://github.com/adfdev/geomapify/
 * *******************************************************
 */
(function ( $ ) {

  var settingsGeomapifyInternal = {
    errorKey: 'geomapify: Google Maps API KEY not found!'
  }

  $.fn.geomapify = function( options ) {
    // Default options
    var settings = $.extend({
      apiKey: 'AIzaSyA7WMruH3VTwVhaby-OLp3_DEXGARet8fU',
      containerInputs: '#containerInputsGoogleMaps',
      mapCanvas: '#mapCanvasGoogleMaps',
      startPosition: "-7.9808971,112.6331616",
      markerOnStartPosition: false,
      filledFieldsOnStartPosition: false,
      fieldAttr: 'google-maps-field',
      draggable: true,
      createJSON: true,
      hideMap: true,
      editFieldsAfterFilled: false,
      editJSONonManualInput: false,
      autocompleteOnEmptyCleanFields: false,
      canvas: {
        zoom: 16,
        gestureHandling: 'cooperative'
      },
      callbacks: {
        filledFields : function (){},
        markerDragged : function (){},
        createJSON : function (){},
        googleMapsScriptLoaded : function (){}
      },
      componentForm: {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        administrative_area_level_2: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      },
      jsonNamesKeys: {}
    }, options );

    if (settings.apiKey == '' || settings.apiKey == undefined || settings.apiKey == null) {
      alert(settingsGeomapifyInternal.errorKey);
      console.log(settingsGeomapifyInternal.errorKey);
      $(settings.containerInputs).remove();
      $(this).remove();
    }
    else{
      settings.autocompleteField = $(this);

      var googleMapsAPI = {
        initAutocomplete: function() {
          autocomplete = new google.maps.places.Autocomplete(
            (settings.autocompleteField[0]),
            {types: ['geocode']});

            autocomplete.addListener('place_changed', googleMapsAPI.fillInAddress);
            settings.autocompleteField.focus(function() {
              googleMapsAPI.geolocate();
              if (settings.editFieldsAfterFilled == true) {
                $(settings.containerInputs).find('['+settings.fieldAttr+']').not('['+settings.fieldAttr+'="json"]').prop('readonly', true);
              }
            });
            if (settings.autocompleteOnEmptyCleanFields == true) {
              settings.autocompleteField.keyup(function() {
                $(settings.containerInputs).find('['+settings.fieldAttr+']').val('');
              });
            }
            if (settings.hideMap == true) {
              if (settings.startPosition != null) {
                var splitLatLong = settings.startPosition.split(',');
                var startPos = new google.maps.LatLng(splitLatLong[0], splitLatLong[1]);
                settings.canvas.center = startPos;
                var map = new google.maps.Map($(settings.containerInputs).find(settings.mapCanvas)[0], settings.canvas);
                if (settings.markerOnStartPosition == true) {
                  new google.maps.Marker({position: startPos, draggable:settings.draggable, map: map});
                }
                if (settings.filledFieldsOnStartPosition == true) {
                  googleMapsAPI.reverseDecode(settings.containerInputs, splitLatLong[0], splitLatLong[1]);
                }
              }
            }
          },
          geolocate: function() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                  center: geolocation,
                  radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
              });
            }
          },
          fillInAddress: function(place) {
            var componentForm = settings.componentForm;
            if (place == undefined) {
              var place = autocomplete.getPlace();
            }
            for (var i = 0; i < place.address_components.length; i++) {
              var addressType = place.address_components[i].types[0];
              if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                $(settings.containerInputs).find('['+settings.fieldAttr+'="'+addressType+'"]').val(val);
              }
            }
            if (settings.hideMap == true) {
              var lat = place.geometry.location.lat();
              var long = place.geometry.location.lng();
              var newPos = new google.maps.LatLng(lat, long);
              settings.canvas.center = newPos;
              var map = new google.maps.Map($(settings.containerInputs).find(settings.mapCanvas)[0], settings.canvas);
              var marker = new google.maps.Marker({position: newPos, draggable:settings.draggable, map: map});
              $(settings.containerInputs).find('['+settings.fieldAttr+'="latitude"]').val(lat);
              $(settings.containerInputs).find('['+settings.fieldAttr+'="longitude"]').val(long);
              if (settings.draggable == true) {
                google.maps.event.addListener(marker, 'dragend', function (event) {
                  var lat = this.getPosition().lat();
                  var long = this.getPosition().lng();
                  $(settings.containerInputs).find('['+settings.fieldAttr+'="latitude"]').val(lat);
                  $(settings.containerInputs).find('['+settings.fieldAttr+'="longitude"]').val(long);
                  settings.callbacks.markerDragged();
                  googleMapsAPI.reverseDecode(lat, long);
                });
              }
            }
            if (settings.createJSON == true) {
              googleMapsAPI.createJSON();
            }
            if (settings.editFieldsAfterFilled == true) {
              $(settings.containerInputs).find('['+settings.fieldAttr+']').not('['+settings.fieldAttr+'="json"]').prop('readonly', false);
              if (settings.editJSONonManualInput == true) {
                $(settings.containerInputs).find('['+settings.fieldAttr+']').not('['+settings.fieldAttr+'="json"]').keyup(function() {
                  googleMapsAPI.createJSON();
                });
              }
            }
            settings.callbacks.filledFields();
          },
          reverseDecode: function (lat, long){
            var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  googleMapsAPI.fillInAddress(results[0]);
                  settings.autocompleteField.val(results[0].formatted_address);
                }
              }
            });
          },
          createJSON: function(){
            var array = [];
            var data = {};
            data['formatted_address'] = settings.autocompleteField.val();
            $(settings.containerInputs).find('['+settings.fieldAttr+']').each(function() {
              var attr = $(this).attr(settings.fieldAttr);
              if (attr != 'json') {
                if (settings.jsonNamesKeys.hasOwnProperty(attr)) {
                  attr = settings.jsonNamesKeys[attr];
                }
                data[attr] = $.trim($(this).val());
              }
            });
            array.push(data);
            var geomapifyArray = {};
            geomapifyArray['geomapify'] = array;
            json = JSON.stringify(geomapifyArray);
            $(settings.containerInputs).find('['+settings.fieldAttr+'="json"]').val(json);
            settings.callbacks.createJSON();
          }
        }
        $.getScript('https://maps.googleapis.com/maps/api/js?key='+settings.apiKey+'&libraries=places', function( data, textStatus, jqxhr ) {
          googleMapsAPI.initAutocomplete();
          settings.callbacks.googleMapsScriptLoaded();
        });
      }
    };

  }( jQuery ));
