/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/shared/map.js]*/
var MapActions = {
  mapUpdatedFromInputs: false,
  inputsUpdatedFromMap: false,
  firstInitialized: false,
  maps: {},
  init: function () {
    var functions = [
      this.initGoogleMap()
    ], self = this;

    for (var i = 0; i < functions.length; ++i) {
      try {
        functions[i].bind(self)();
      } catch (e) {
        window.Sentry && window.Sentry.captureException(e);
        // eslint-disable-next-line no-console
        console.warn(e);
      }
    }
  },

  initMapSearch: function (id) {
    var $map = $('#' + id);
    var mapContainer = $map.closest('.js-map-container');
    var addressSidebarContainer = $('.js-address-sidebar-container')
    var addressModuleActive = isModuleActive('address_modal_v3')
    var mapSearchContent = isModuleActive('address_modal_v3') ?
      addressSidebarContainer.find('.js-search-map-content')
      :
      mapContainer.find('.js-search-map-content')
    ;
    var mapSearchInput = isModuleActive('address_modal_v3') ?
      addressSidebarContainer.find('.js-search-map-input')
      :
      mapContainer.find('.js-search-map-input');

    var searchAjax;
    var thiz = this;
    var searchMapCancel =$('.js-search-map-cancel');
    var searchLag;

    mapSearchInput.focus(function () {
      mapContainer.addClass('search-open');
      try {
        gtag('event', 'click', {
          'event_category': 'Map Tracking',
          'event_action': 'Focus on Search Bar in Map',
          'event_label': window.pageName,
          'non_interaction': true
        });
      } catch (e) {

      }
    });

    mapSearchInput.on('click', function (e) {
      e.stopPropagation();
    });

    mapContainer.on('click', function () {
      mapContainer.removeClass('search-open')
    });

    mapSearchInput.on('input', function () {
      if(searchLag) {
        clearTimeout(searchLag);
      }
      if($(this).val() === '') {
        searchMapCancel.addClass('u-hidden');
      } else {
        searchMapCancel.removeClass('u-hidden');
      }
      var center = isModuleActive('parsi_map') ? thiz.maps[id].getCenter() : thiz.maps[id].center;

      if (center) {
        searchLag = setTimeout(function () {
          searchAjax = Services.ajaxPOSTRequestJSON(
            '/addresses/search-address',
            {
              address: mapSearchInput.val(),
              latitude: isModuleActive('parsi_map') ? center.lat : center.lat(),
              longitude: isModuleActive('parsi_map') ? center.lng : center.lng()
            },
            function (data) {
              mapSearchContent.html('');
              var mapResult = '';
              $.map(data, function (val, i) {
                if (addressModuleActive) {
                  mapResult = mapResult + `<div class="c-map__search-item-container">
                                                            <div data-icon="Icon-Location-Pin" class="c-map__search-item-icon">

                                                            </div>
                                                            <div class="c-map__search-item c-map__search-item--address-v3 js-map-search-item" data-lng="${val.longitude}" data-lat="${val.latitude}">
                                                                <div class="c-map__search-item-title js-map-search-item-title">${val.title}</div>
                                                                <div class="c-map__search-item-desc">${val.address}</div>
                                                            </div>
                                                        </div>
                                                        `
                } else {
                  mapResult = mapResult + '<div class="c-map__search-item js-map-search-item" data-lng="' + val.longitude +'" data-lat="' + val.latitude +'">\n' +
                    '                <div class="c-map__search-item-title js-map-search-item-title">' + val.title + '</div>\n' +
                    '                <div class="c-map__search-item-desc">' + val.address + '</div>\n' +
                    '            </div>'
                }
              });
              mapSearchContent.html(mapResult);
            },
            function (data) {
              console.log(data.errors);
            }
          );
        }, 500);
      }
    });

    $(document).on('click', '.js-map-search-item', function (e) {
      e.stopPropagation();
      if (isModuleActive('parsi_map')) {
        thiz.maps[id].setCenter([$(this).data('lng'), $(this).data('lat')]);
        if (isModuleActive('address_modal_v3')) {
          thiz.maps[id].fire('dragend')
        }
      } else {
        thiz.maps[id].setCenter(new google.maps.LatLng($(this).data('lat'), $(this).data('lng')));
      }
      mapSearchInput.val($(this).find('.js-map-search-item-title').html());
      searchMapCancel.removeClass('u-hidden');
    });

    searchMapCancel.on('click', function (e) {
      e.stopPropagation();
      mapSearchInput.val('');
      mapContainer.removeClass('search-open');
      $(this).addClass('u-hidden');
    })
  },

  initGoogleMap: function (upperThis, id, position, hasSearch) {
    var thiz = this;
    var $map = $('#' + id);
    var mapContent = $('#address-modal-map');
    var formContent = $('#address-modal-form');
    var currentLocationMap = null;
    var currentLocationIcon = $map.data('current-icon');
    var currentLocationBtn = $('.js-go-to-my-location');
    var addressModal = $('[data-remodal-id=add-edit-address]').remodal();
    var $addressForm = $('#add-edit-address-form');
    var addLocationBtn = $('.js-add-location-btn');

    position = (position && (position.lat && position.lng)) ? position : {
      lat: 0,
      lng: 0
    };

    try {
      ga('set', 'nonInteraction', true);
      ga('send', 'event', {
        eventCategory: 'DK-Address-Modal',
        eventAction:'AddressModalOpenDesktop',
        eventLabel: id
      });
    } catch (e) {

    }

    if (parseInt(position.lat) !== 0 && parseInt(position.lng) !== 0) {
      $map.closest('.js-map-interactive').addClass('c-map__container--static');
    } else {
      $map.closest('.js-map-interactive').removeClass('c-map__container--static');
    }

    function initMapInner(position) {
      var interactiveMap;

      function initMap() {
        if(isModuleActive('parsi_map')) {
          thiz.maps[id] = new parsimap.Map(document.getElementById(id), {
            center: [parseFloat(position.lng), parseFloat(position.lat)],
            zoom: 14,
            style: "parsimap://street"
          });
        } else {
          thiz.maps[id] = new google.maps.Map(document.getElementById(id), {
            center: {lat: parseFloat(position.lat), lng: parseFloat(position.lng)},
            zoom: 15,
            fullscreenControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            scaleControl: false,
          });
        }

        thiz.maps[id].addListener('click', function (e) {
          e.stop()
        });

        try {
          ga('set', 'nonInteraction', true);
          ga('send', 'event', {
            eventCategory: 'DK-Address-Modal',
            eventAction:'GoogleMapInitDesktop',
            eventLabel: id
          });
        } catch (e) {

        }
      }

      function updateInputs(lat, lng, $form) {
        var $addressField = $form.find('.js-address-field');

        if (thiz.mapUpdatedFromInputs) {
          return;
        }

        if (lat > 0 && lng > 0) {
          Services.ajaxPOSTRequestJSON(
            '/addresses/search-address-reverse',
            {'latitude': lat, 'longitude': lng},
            function (data) {
              upperThis.selectedCityId = data.city_id;
              $form.find('.js-select-state').val(data.state_id).selectric('refresh').change();
              $form.find('.js-select-city').val(data.city_id).selectric('refresh').change();
              /*$form.find("textarea[name='address[address]']").val(data.address);*/

              if(isModuleActive('parsi_map')) {
                $addressField.find('.js-input-field').val(data.address);
              } else {
                if ($addressField.children('textarea').val() !== data.address) {
                  if ($addressField.children('.c-map__address-tip').length === 0) {
                    $addressField.append('<div class="c-map__address-tip">تغییر بر اساس موقعیت جدید نقشه<div class="c-map__address-tip-link js-update-address-map" data-address="' + data.address + '">تایید</div></div>');
                    $addressField.children('textarea').addClass('c-ui-textarea__field--has-tip');
                  } else {
                    $addressField.find('.js-update-address-map').data('address', data.address);
                  }
                }
              }

              thiz.inputsUpdatedFromMap = true;
            },
            function (data) {
              console.log(data.errors);
            }
          );
        }
      }

      try {
        if (thiz.maps[id]) {
          if (isModuleActive('parsi_map')) {
            thiz.maps[id].flyTo([position.lng, position.lat], 14, 1);
          } else {
            thiz.maps[id].setCenter(new google.maps.LatLng(position.lat, position.lng));
          }
        } else {
          initMap();
        }
      } catch (e) {

      }

      if (!thiz.firstInitialized) {
        $('.js-edit-map-btn').on('click', function () {
          $(this).closest('.js-map-interactive').removeClass('c-map__container--static');
        });

        $('.js-select-address-map').on('click', function () {
          interactiveMap = $(this).closest('.js-map-interactive');
          var $this = $(this);

          try {
            gtag('event', 'click', {
              'event_category': 'Map Tracking',
              'event_action': 'Submit the Map',
              'event_label': window.pageName,
              'non_interaction': true
            });
          } catch (e) {

          }

          var location = {};
          if (isModuleActive('parsi_map')) {
            location.lat = thiz.maps[id].getCenter().lat;
            location.lng = thiz.maps[id].getCenter().lng;
          } else {
            location.lat = thiz.maps[id].center.lat();
            location.lng = thiz.maps[id].center.lng();
          }

          if(Math.ceil(location.lng * 10000000) === 513353777 && Math.ceil(location.lat * 10000000) === 357013221) {
            window.DKToast('لطفا موقعیت مکانی خود را انتخاب کنید');
            return;
          }

          if(isModuleActive('mandatory_location_shipping') && $(this).data('mode') === 'location') {
            $(this).data('mode', '');
            var rawAddressData = $('#user-default-address-container').data('address');
            var addressData = {
              'address': {
                'first_name': rawAddressData.first_name,
                'last_name': rawAddressData.last_name,
                'full_name': rawAddressData.full_name,
                'national_id': rawAddressData.national_id,
                'mobile_phone': rawAddressData.mobile_phone,
                'state_id': rawAddressData.state_id,
                'city_id': rawAddressData.city_id,
                'district_id': rawAddressData.district_id,
                'address': rawAddressData.address,
                'post_code': rawAddressData.post_code,
                'apt_id': rawAddressData.apt_id,
                'bld_num': rawAddressData.bld_num,
                'lat': location.lat,
                'lng': location.lng,
                'novalidate_point': true
              }
            };
            Services.ajaxPOSTRequestJSON(
              '/ajax/addresses/edit/' + rawAddressData.id + '/',
              addressData,
              function () {
                addLocationBtn.remove();
                $addressForm[0].reset();

                if($this.data('has-submit')) {
                  $this.data('has-submit', false);
                  $('#shipping-data-form').submit();
                } else {
                  addressModal.close();
                }
              },
              function (response) {
                addressModal.open();
                var $errorItems = $addressForm.find('.js-form-error-items');
                $errorItems.empty();
                $.each(response.errors, function (i, item) {
                  $errorItems.append('<p>' + __(item) + '</p>');
                });

                $addressForm.find('.js-form-errors').removeClass('u-hidden-visually');
              },
              true,
              true
            );
          } else {
            if(!isModuleActive('new_address_modal')) {
              $(this).closest('.js-map-interactive').addClass('c-map__container--static');
            };

            interactiveMap.find('[name = "address[lat]"]').val(location.lat);
            interactiveMap.find('[name = "address[lng]"]').val(location.lng);
            updateInputs(location.lat, location.lng, $(this).closest('form'));

            if(isModuleActive('new_address_modal')) {
              mapContent.addClass('u-hidden');
              formContent.removeClass('u-hidden');
            }
          }
        });

        if(isModuleActive('new_address_modal')) {
          if(isModuleActive('map_current_location')) {
            if (isModuleActive('parsi_map')) {
              thiz.maps[id].on('load', function () {
                window.navigator.geolocation.watchPosition(
                  function (pos) {
                    var position = pos.coords;

                    if (currentLocationMap === null) {
                      thiz.maps[id].addSource("current_location", {
                        type: "FeatureCollection",
                        features: [
                          {
                            type: "Feature",
                            properties: { image: "current", width: 5 },
                            geometry: {
                              type: "Point",
                              coordinates: [position.longitude, position.latitude]
                            }
                          }
                        ]
                      });
                      currentLocationMap = thiz.maps[id].getSource("current_location");
                      var imageCollection = [{ name: "current", url: currentLocationIcon }];
                      thiz.maps[id].loadImageCollection(imageCollection, function() {
                        thiz.maps[id].addSymbolLayer("marker", "current_location", { layout: { "icon-image": "current", "icon-anchor": "center" } });
                      });
                    }

                    currentLocationBtn.removeClass('u-hidden');

                    var data = currentLocationMap.data;
                    data.features[0].geometry.coordinates = [position.longitude, position.latitude];
                    currentLocationMap.setData(data);

                  },
                  function () {
                  },
                );
              })
            } else {
              window.navigator.geolocation.watchPosition(
                function (pos) {
                  var position = pos.coords;

                  if (currentLocationMap === null) {
                    currentLocationMap = new google.maps.Marker({
                      position: {lat: position.latitude, lng: position.longitude},
                      map: thiz.maps[id],
                      icon: {url: currentLocationIcon, origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(17, 17)}
                    });
                  }

                  currentLocationBtn.removeClass('u-hidden');

                  currentLocationMap.setPosition(new google.maps.LatLng(position.latitude, position.longitude));

                },
                function () {
                },
              );
            }

            currentLocationBtn.on('click', function () {
              navigator.geolocation.getCurrentPosition(function (pos) {
                  var position = {};
                  currentLocationBtn.removeClass('is-unavailable');
                  position.lat = pos.coords.latitude;
                  position.lng = pos.coords.longitude;
                  initMapInner(position);
                }, function () {
                  currentLocationBtn.addClass('is-unavailable');
                },
                {
                  enableHighAccuracy: true,
                  timeout: 8000
                });
            });
          };
        }

        $(document).on('click', '.js-update-address-map', function () {
          var $addressField = $(this).closest('.js-address-field');
          $addressField.children('textarea').val($(this).data('address'));
          $addressField.children('textarea').removeClass('c-ui-textarea__field--has-tip');
          $(this).parent().remove();
        });

        thiz.firstInitialized = true;

        if (hasSearch) {
          thiz.initMapSearch(id);
        }
      }
    }

    try {
      if (parseInt(position.lat) === 0 || parseInt(position.lng) === 0) {
        initMapInner({lat: 35.7013221, lng: 51.3353777});
        navigator.geolocation.getCurrentPosition(function (pos) {
            if (isModuleActive('map_current_location'))
              currentLocationBtn.removeClass('is-unavailable');
            position.lat = pos.coords.latitude;
            position.lng = pos.coords.longitude;
            initMapInner(position);
          }, function () {
            if (isModuleActive('map_current_location'))
              currentLocationBtn.addClass('is-unavailable');
          },
          {
            enableHighAccuracy: true,
            timeout: 8000
          });
      } else {
        initMapInner(position);
      }
    } catch (e) {

    }
  },
  initAddressV3(id) {
    function updateAddressOnChange(e) {
      $(document).trigger('changeReverseAddressInProgress');
      Services.ajaxPOSTRequestJSON(
        '/addresses/search-address-reverse',
        {'latitude': map.getCenter().lat, 'longitude': map.getCenter().lng},
        function (data) {
          $(document).trigger('changeReverseAddress', data);
        },
        function (data) {
          console.log(data.errors);
        }
      );

    }
    var map = MapActions.maps[id];

    map.on('dragend', updateAddressOnChange);
    map.on('dblclick', updateAddressOnChange);
    map.on('zoomend', updateAddressOnChange);
  }
};



/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/shared/address.js]*/
var addressActions = {
  selectedCityName: '',
  mapUpdatedFromInputs: false,
  init: function () {
    var functions = [
      this.initUpdateCities,
      this.initUpdateDistricts,
      this.initChangeAddress,
      this.initAddressModals,
      this.initSelects,
      this.initFormValidation,
      this.initAddressGA
    ], self = this;

    if(isModuleActive('new_address_improvement'))
      functions.push(this.initRecipient);
    if (isModuleActive('address_modal_v3')) {
      functions.push(this.initAddressModuleV3);
    }
    for (var i = 0; i < functions.length; ++i) {
      try {
        functions[i].bind(self)();
      } catch (e) {
        window.Sentry && window.Sentry.captureException(e);
        // eslint-disable-next-line no-console
        console.warn(e);
      }
    }
    if (isModuleActive('address_modal_v3')) {
      if (window.location.href.indexOf('addresses/add/') > 0) {
        $('.js-add-address-btn').trigger('click');
      }
    }
  },

  initAddressGA: function () {
    $('.js-address-address').focus(function () {
      try {
        gtag('event', 'click', {
          'event_category': 'Map Tracking',
          'event_action': 'Focus to Edit the Written Address',
          'event_label': window.pageName,
          'non_interaction': true
        });
      } catch (e) {

      }
    })
  },

  initRecipient: function () {
    var $firstNameInput = $('[name="address[first_name]"]'),
      $lastNameInput = $('[name="address[last_name]"]'),
      $mobilePhoneInput = $('[name="address[mobile_phone]"]'),
      $nationalIdInput = $('[name="address[national_id]"]'),
      $recipientCheck = $('.js-recipient-is-me'),
      status = $recipientCheck.is(':checked'),
      userData = window.userInformation || {};

    if(!(userData.firstName && userData.lastName && userData.mobile && userData.nationalSecurityNumber)) {
      $recipientCheck.prop('checked', false).change();;
      $recipientCheck.closest('.js-recipient-is-me-container').remove();
      status = false;
    }

    $recipientCheck.on('change', function () {
      status = $recipientCheck.is(':checked');
      if(status) {
        $firstNameInput.addClass('disabled').attr('disabled', status);
        $lastNameInput.addClass('disabled').attr('disabled', status);
        $mobilePhoneInput.addClass('disabled').attr('disabled', status);
        $nationalIdInput.addClass('disabled').attr('disabled', status);
        if (isModuleActive('address_modal_v3')) {
          $('.js-address-details').addClass('u-hidden')
        }
      } else {
        $firstNameInput.removeClass('disabled').attr('disabled', status);
        $lastNameInput.removeClass('disabled').attr('disabled', status);
        $mobilePhoneInput.removeClass('disabled').attr('disabled', status);
        $nationalIdInput.removeClass('disabled').attr('disabled', status);
        if (isModuleActive('address_modal_v3')) {
          $('.js-address-details').removeClass('u-hidden')
        }
      }

      if(status) {
        $firstNameInput.val(userData.firstName);
        $lastNameInput.val(userData.lastName);
        $mobilePhoneInput.val(userData.mobile);
        $nationalIdInput.val(userData.nationalSecurityNumber);

        try {
          gtag('event', 'click', {
            'event_category': 'Map Tracking',
            'event_action': 'Activate Recipient is Self',
            'event_label': window.pageName,
            'non_interaction': true
          });
        } catch (e) {

        }
      } else {
        $firstNameInput.val('');
        $lastNameInput.val('');
        $mobilePhoneInput.val('');
        $nationalIdInput.val('');
      }
    });
  },

  addUpdate: function (url, successCallback, failCallback) {

    var mobilePhone = $('.js-address-mobile-phone').val(),
      stateId = $('.js-address-state-id').val(),
      cityId = $('.js-address-city-id').val(),
      districtId = $('.js-address-district-id').val(),
      address = $('.js-address-address').val(),
      buildingNumber = $('.js-address-building-number').val(),
      apartmentNumber = $('.js-address-apartment-number').val(),
      postalCode = $('.js-address-postal-code').val(),
      addressData;

    if(isModuleActive('new_address_improvement')) {
      var firstName = $('.js-address-first-name').val(),
        lastName = $('.js-address-last-name').val(),
        nationalId = $('.js-address-national-id').val();

      addressData = {
        'address': {
          'first_name': firstName,
          'last_name': lastName,
          'national_id': nationalId,
          'mobile_phone': mobilePhone,
          'state_id': stateId,
          'city_id': cityId,
          'district_id': districtId,
          'address': address,
          'post_code': postalCode,
          'apt_id': apartmentNumber,
          'bld_num': buildingNumber
        }
      };
    } else {
      var fullName = $('.js-address-full-name').val();

      addressData = {
        'address': {
          'full_name': fullName,
          'mobile_phone': mobilePhone,
          'state_id': stateId,
          'city_id': cityId,
          'district_id': districtId,
          'address': address,
          'post_code': postalCode,
          'apt_id': apartmentNumber,
          'bld_num': buildingNumber
        }
      };
    }

    Services.ajaxPOSTRequestJSON(
      url,
      addressData,
      function (response) {
        $('.addresses-section').html(response.data);
        $('.addresses-section-online-return-edit').html(response.editData);
        $('.time-scopes-section').html(response.timeScopes);
        $('.time-scopes-section').show();
        $('.js-online-return-edit-btn').show();
        $('.time-scopes-section').html(response.timeScopes);
        $('#address-id').val(response.defaultAddressId);
        $('#user-default-address-container').show();
        $('#user-address-list-container').hide();
        successCallback(response);
      },
      function (response) {
        failCallback(response);
      },
      true,
      true
    );
  },


  delete: function (e, url, successCallback, failCallback) {
    e.stopPropagation();
    DKConfirm(
      'آیا مطمئنید که این آدرس حذف شود؟',
      function () {
        Services.ajaxPOSTRequestJSON(
          url,
          null,
          function (response) {
            successCallback(response);
          },
          function (response) {
            failCallback(response);
          },
          true,
          true
        );
      },
      function () {
      },
      'بله',
      'خیر'
    );
  },

  initSelects: function () {
    $('.js-ui-select').selectric();
  },

  initFormValidation: function () {
    var validationConfig = {
      ignore: [],
      rules: {
        'address[mobile_phone]': {
          mobile_phone: true,
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11
        },
        'address[state_id]': {
          required: true
        },
        'address[city_id]': {
          required: true
        },
        'province': {
          required: true
        },
        'address[district_id]': {
          required: {
            depends: function () {
              return $('.js-district-wrapper').is(':visible');
            }
          }
        },
        'address[post_code]': {
          required: true,
          digits: true,
          rangelength: [10, 10]
        },
        'address[address]': {
          required: true,
          minlength: 10,
          maxlength: 350,
          notOnlyNumber: true,
          notEmailAddress: true
        },
        'address[bld_num]': {
          required: true,
          maxlength: 10,
        }
      },
      messages: {
        'address[mobile_phone]': {
          'required': 'فیلد الزامی است',
          'digits': 'شماره موبایل را درست وارد نمایید',
          'minlength': 'شماره موبایل را کامل وارد نمایید',
          'maxlength': 'شماره موبایل را درست وارد نمایید',
          'mobile_phone': 'شماره موبایل نامعتبر است'
        },
        'province': {
          'required': 'فیلد الزامی است'
        },
        'address[state_id]': {
          'required': 'فیلد الزامی است'
        },
        'address[city_id]': {
          'required': 'فیلد الزامی است'
        },
        'address[district_id]': {
          'required': 'فیلد الزامی است'
        },
        'address[post_code]': {
          'required': 'کد پستی الزامی است',
          'digits': 'فقط مقدار عددی مجاز است',
          'rangelength': 'کد پستی را درست وارد نمایید'
        },
        'address[address]': {
          'required': 'فیلد الزامی است',
          'minlength': 'آدرس وارد شده کوتاه است',
          'maxlength': 'لطفا آدرس را کوتاه‌تر وارد نمایید',
          'notOnlyNumber': 'آدرس وارد شده نمی تواند فقط شامل اعداد باشد',
          'notEmailAddress': 'آدرس نمی تواند شامل ایمیل باشد'
        },
        'address[bld_num]': {
          'required': 'پلاک را وارد نمایید',
          'maxlength': 'شماره پلاک را درست وارد نمایید'
        }
      }
    };

    if(isModuleActive('new_address_improvement')) {
      validationConfig.rules['address[first_name]'] = { required: true, rangelength: [3, 255] };
      validationConfig.rules['address[last_name]'] = { required: true, rangelength: [3, 255] };
      validationConfig.rules['address[national_id]'] = { required: true, digits: true, rangelength: [10, 10] };

      validationConfig.messages['address[first_name]'] = {
        'required': 'نام خود را وارد نمایید',
        'rangelength': 'نام معتبر نیست',
      };

      validationConfig.messages['address[last_name]'] = {
        'required': 'نام خانوادگی را وارد نمایید',
        'rangelength': 'نام خانوادگی معتبر نیست',
      };

      validationConfig.messages['address[national_id]'] = {
        'required': 'کد ملی نمی‌تواند خالی باشد',
        'digits': 'فقط مقدار عددی مجاز است',
        'rangelength': 'کد ملی نامعتبر است',
      };
    } else {
      validationConfig.rules['address[full_name]'] = { required: true, rangelength: [3, 255] };
      validationConfig.messages['address[full_name]'] = {
        'required': 'فیلد الزامی است',
        'rangelength': 'نام را درست وارد نمایید',
      };
    }

    $('#add-edit-address-form').validate(validationConfig);

    $('.js-ui-select,.js-input-field').on('change', function () {
      $(this).valid();
    });
  },

  initUpdateCities: function () {
    var thiz = this;
    $(document).on('change', '.js-select-state', function () {
      var $thiz = $(this);
      var $form = $thiz.closest('#add-edit-address-form');
      if($form.length === 0)
        $form = $thiz.closest('form');
      var stateId = $thiz.val();
      var $citySelector = $form.find('.js-select-city');
      if (!stateId || stateId.length === 0)
        return;

      Services.ajaxGETRequestJSON(
        '/ajax/state/cities/' + stateId,
        null,
        function (data) {
          $citySelector.children('select .js-not-empty').remove();
          $.each(data, function (index, city) {
            $('<option>').val(city.id).text(city.name).addClass('js-not-empty').appendTo($citySelector);
            if (thiz.selectedCityName.length > 0 && city.name == thiz.selectedCityName) {
              thiz.selectedCityId = city.id;
            }
          });

          if (thiz.selectedCityId > 0) {
            $citySelector.val(thiz.selectedCityId);
          }

          $citySelector.selectric('refresh').change();
          $('.js-district-wrapper').hide();
        },
        function (data) {
          console.log(data.errors);
        }
      );
    });
  },

  initChangeAddress: function () {
    $(document).on('click', '#change-address-btn', function (e) {
      e.stopPropagation();
      e.preventDefault();
      if ($('.js-recipient-box').length === 1) {
        $('.js-add-address-btn').trigger('click');
      } else {
        $('#user-default-address-container').hide();
        $('#user-address-list-container').show();
      }
    });

    $(document).on('click', '#cancel-change-address-btn', function () {
      $('#user-address-list-container').hide();
      $('#user-default-address-container').show();
    });
  },

  initUpdateDistricts: function () {
    var thiz = this;
    $('.js-district-wrapper').hide();
    $(document).on('change', '.js-select-city', function () {
      var $thiz = $(this);
      var $form = $thiz.closest('#add-edit-address-form');
      var cityId = $thiz.val();
      var $districtSelector = $form.find('.js-select-district');

      if (!cityId || cityId.length === 0) {
        return;
      }

      Services.ajaxGETRequestJSON(
        '/ajax/city/districts/' + cityId,
        null,
        function (data) {
          if (data.length !== 0) {
            $('.js-district-wrapper').show();
          } else {
            $('.js-district-wrapper').hide();
            $districtSelector.children('select .js-not-empty').remove();
            $districtSelector.selectric('refresh');
          }

          $districtSelector.children('select .js-not-empty').remove();
          $.each(data, function (index, district) {
            $('<option>').val(district.id).text(district.name).addClass('js-not-empty').appendTo($districtSelector);
          });

          if (thiz.selectedDistrictId > 0) {
            $districtSelector.val(thiz.selectedDistrictId);
          }

          $districtSelector.selectric('refresh').change();

          $(document).trigger(jQuery.Event('mapInit'));
        },
        function (data) {
          console.log(data.errors);
        }
      );
    });
    $(document).on('change', '.js-select-city, .js-select-district, .js-select-state', function () {
      $(this).selectric('refresh');
    })
  },

  initAddressModals: function () {
    var mapContent = $('#address-modal-map');
    var formContent = $('#address-modal-form');
    var thiz = this;
    var recipient;
    var isFirst = false;
    var $addressForm = $('#add-edit-address-form');
    var addressModal = $('[data-remodal-id=add-edit-address]').remodal();
    var mapAddress = $('.js-map-address-container');
    var selectLocationBtn = $('.js-select-address-map');
    var addressModalTitle = $('.js-address-modal-title');
    var addressModalSubtitle = $('.js-address-modal-subtitle');
    var addressContainer = $('.js-address-container');
    var mapContainer = $('.js-map-container');
    var isModal = true;
    var oldTitle = "";

    $('#add-edit-address-form').on('submit', function () {
      try {
        gtag('event', 'click', {
          'event_category': 'Map Tracking',
          'event_action': 'Submit the Address',
          'event_label': window.pageName,
          'non_interaction': true
        });
      } catch (e) {

      }
    })

    $(document).on('click', '.js-add-address-btn', function () {
      if(isModuleActive('new_address_modal') && isModuleActive('address_geolocation')) {
        mapContent.removeClass('u-hidden');
        formContent.addClass('u-hidden');
      }
      $addressForm.data('mode', 'add');
      isModal = !$(this).data('not-modal');

      $(document).off('change.map', '.js-select-state, .js-select-city, .js-select-district, textarea[name="address[address]"]');

      if(isModuleActive('new_address_improvement')) {
        var $recipientCheck = $addressForm.find('.js-recipient-is-me');
        $addressForm.find('[name="address[first_name]"]').val('');
        $addressForm.find('[name="address[last_name]"]').val('');
        $addressForm.find('[name="address[national_id]"]').val('');
        if($recipientCheck)
          $recipientCheck.prop('checked', false).change();
      } else {
        $addressForm.find('[name="address[full_name]"]').val('');
      }

      $addressForm.find('[class="js-address-id"]').val('');
      $addressForm.find('[name="address[mobile_phone]"]').val('');
      $addressForm.find('[name="address[post_code]"]').val('');
      $addressForm.find('[name="address[address]"]').val('');
      $addressForm.find('[name="address[state_id]"]').val('').selectric('refresh').change();
      $addressForm.find('[name="address[bld_num]"]').val('');
      $addressForm.find('[name="address[apt_id]"]').val('');
      $addressForm.find('.js-select-city').val('').selectric('refresh').change();
      $addressForm.find('.js-select-district').val('').selectric('refresh').hide();
      $addressForm.find('.js-address-modal-title').html('افزودن آدرس جدید');
      $('#add-edit-address-form .js-form-errors').addClass('u-hidden-visually');
      $('#add-edit-address-form .js-form-error-items').empty();
      var addAddressModal = $('[data-remodal-id=add-edit-address]').remodal();
      if (isModuleActive('address_geolocation')) {
        addressModalTitle.html('آدرس جدید');
        selectLocationBtn.text("ثبت و افزودن جزییات");
      }
      /*thiz.initAddAddressForm();*/
      thiz.selectedCityId = 0;
      thiz.selectedDistrictId = 0;
      if(isModal) {
        addAddressModal.open();
        if (isModuleActive('address_modal_v3')) {
          addAddressModal.$wrapper.css('padding', '0')
        }
      }

      $(document).on('closeAddressModal', function () {
        addAddressModal.close();
      });

      if (isModuleActive('address_geolocation')) {
        $(document).off('change.map', '.js-select-state, .js-select-city, .js-select-district, textarea[name="address[address]"]');
        MapActions.initGoogleMap(thiz,'map', {}, true);
        if (isModuleActive('address_modal_v3')) {
          MapActions.initAddressV3('map');
        }
      }

      try {
        gtag('event', 'click', {
          'event_category': 'Map Tracking',
          'event_action': 'Adding a New Address',
          'event_label': window.pagenName,
          'non_interaction': true
        });
      } catch (e) {

      }
    });

    if(isModuleActive('mandatory_location_shipping')) {
      $(document).on('closed', addressModal, function () {
        mapAddress.addClass('u-hidden');
        selectLocationBtn.data('mode', '').data('has-submit', false);
        $('.js-add-location-btn').data('is-submit', false);
      });
    }

    $(document).on('click', '.js-add-location-btn', function (e) {
      e.preventDefault();
      e.stopPropagation();
      addressContainer.addClass('u-hidden');
      mapContainer.removeClass('u-hidden');
      if($(this).data('is-submit')) {
        $(this).data('is-submit', false);
        addressModalTitle.text('تعیین موقعیت مکانی آدرس بر روی نقشه');
        selectLocationBtn.text("ثبت موقعیت مکانی و ادامه").data('mode', 'location').data('has-submit', true);
        mapAddress.removeClass('u-hidden');
        mapAddress.find('.js-map-address').text($(this).data('address'));
      } else {
        mapAddress.addClass('u-hidden');
        addressModalTitle.text('تعیین موقعیت مکانی آدرس');
        selectLocationBtn.text("ثبت موقعیت مکانی").data('mode', 'location');
      }
      if(isModal) {
        addressModal.open();
        if (isModuleActive('address_modal_v3')) {
          addressModal.$wrapper.css('padding', '0')
        }
      }
      MapActions.initGoogleMap(thiz,'map', {}, true);
      if (isModuleActive('address_modal_v3')) {
        MapActions.initAddressV3('map');
      }
    });

    $(document).on('click', '.js-edit-address-btn', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if(isModuleActive('new_address_modal') && isModuleActive('address_geolocation')) {
        mapContent.removeClass('u-hidden');
        formContent.addClass('u-hidden');
      }
      $addressForm.data('mode', 'edit');
      var $container = $(this).closest('.js-user-address-container');
      recipient = $container.data('address');
      thiz.recipient = recipient;

      if (isModuleActive('address_geolocation')) {
        addressModalTitle.html('ویرایش آدرس');
        selectLocationBtn.text("ثبت و افزودن جزییات");
      }

      $('#add-edit-address-form .js-form-errors').addClass('u-hidden-visually');
      $('#add-edit-address-form .js-form-error-items').empty();
      var editAddressModal = $('[data-remodal-id=add-edit-address]').remodal();

      editAddressModal.open();
      $(document).off('change.map', '.js-select-state, .js-select-city, .js-select-district, textarea[name="address[address]"]');

      if(isModuleActive('new_address_improvement')) {
        $addressForm.find('[name="address[first_name]"]').val(recipient.first_name);
        $addressForm.find('[name="address[last_name]"]').val(recipient.last_name);
        $addressForm.find('[name="address[national_id]"]').val(recipient.national_id);
        var $recipientCheck = $addressForm.find('.js-recipient-is-me');
        if($recipientCheck)
          $recipientCheck.prop('checked', false).change();
      } else {
        $addressForm.find('[name="address[full_name]"]').val(recipient.full_name);
      }

      $addressForm.find('[class="js-address-id"]').val(recipient.id);
      $addressForm.find('[name="address[mobile_phone]"]').val(recipient.mobile_phone);
      $addressForm.find('[name="address[post_code]"]').val(recipient.post_code);
      $addressForm.find('[name="address[address]"]').val(recipient.address);
      $addressForm.find('[name="address[bld_num]"]').val(recipient.building_no);
      $addressForm.find('[name="address[apt_id]"]').val(recipient.unit);
      $addressForm.find('[name="address[state_id]"]').val(recipient.state_id).selectric('refresh').change();
      $addressForm.find('.js-address-modal-title').html('ویرایش آدرس');
      thiz.selectedCityId = recipient.city_id;
      $addressForm.find('.js-select-city').val(thiz.selectedCityId).change();

      if (recipient.district_id) {
        thiz.selectedDistrictId = recipient.district_id;
        $addressForm.find('.js-select-district').val(thiz.selectedDistrictId).selectric('refresh');
      }
      isFirst = true;
      if (isModuleActive('address_modal_v3')) {
        editAddressModal.$wrapper.css('padding', '0');
        MapActions.initGoogleMap(thiz,'map', {}, true);
        MapActions.initAddressV3('map');
      }
      $(document).on('closeAddressModal', function () {
        editAddressModal.close();
      });
      try {
        gtag('event', 'click', {
          'event_category': 'Map Tracking',
          'event_action': 'Edit a New Address',
          'event_label': window.pagenName,
          'non_interaction': true
        });
      } catch (e) {

      }
    });

    $(document).on('mapInit', function () {
      if (isModuleActive('address_geolocation') && isFirst) {
        MapActions.initGoogleMap(thiz, 'map', {lat: recipient.map_lat, lng: recipient.map_lon}, true);
        if (isModuleActive('address_modal_v3')) {
          MapActions.initAddressV3('map');
        }
        isFirst = false;
      }
    });

    $('.js-select-address-map').on('click', function () {
      oldTitle = addressModalTitle.text();
      addressModalTitle.text('جزئیات آدرس');
      if(!isModal)
        addressModalSubtitle.text('لطفا جزئیات آدرس و گیرنده سفارش را وارد کنید.');
    });

    $('.js-back-to-map').on('click', function () {
      mapContent.removeClass('u-hidden');
      formContent.addClass('u-hidden');
      addressModalTitle.text(oldTitle);
      if(!isModal)
        addressModalSubtitle.text('لطفا موقعیت مکانی آدرس را بر روی نقشه تعیین کنید.')

      try {
        gtag('event', 'click', {
          'event_category': 'Map Tracking',
          'event_action': 'Edit the Location on The Map',
          'event_label': window.pageName,
          'non_interaction': true
        });
      } catch (e) {

      }
    });
  },

  initAddressModuleV3() {
    var $addressModal = $('#address-modal-map');

    addressActions.isAddressSearchOpen = false;
    addressActions.onSearchClick($addressModal);
    addressActions.onAddressModalBack($addressModal);
    addressActions.onChangeReverseAddress($addressModal);
    addressActions.onEditAddressClick($addressModal);
    addressActions.onChangeReverseAddressInProgress($addressModal);
  },
  toggleSearchAddress() {
    var $addressModal = $('#address-modal-map');
    $addressModal.find('.js-modal-search-map-header').toggleClass('u-hidden').trigger('focus');
    $addressModal.find('.js-search-map-content').toggleClass('u-hidden');
    $addressModal.find('.js-modal-text-header').toggleClass('u-hidden');
  },
  onSearchClick($addressModal) {
    $addressModal.on('click', '.js-modal-search-field, .js-search-address-btn', function () {
      addressActions.toggleSearchAddress();
      addressActions.isAddressSearchOpen = true;
    });
  },
  onAddressModalBack($addressModal) {
    $addressModal.on('click', '.js-address-modal-back', function () {
      if (addressActions.isAddressSearchOpen) {
        $addressModal.find('.js-modal-search-field').trigger('click');
        addressActions.isAddressSearchOpen = false;
      } else {
        if (window.location.href.indexOf('addresses/add/') > 0) {
          window.history.go(-1);
        } else {
          $(document).triggerHandler('closeAddressModal');
        }
      }
    });
  },
  onChangeReverseAddress($addressModal) {
    var $addressForm = $('#add-edit-address-form')
    var cityId;
    $(document).on('changeReverseAddress', function (e, data) {
      $addressModal.find('.js-loading-animation').addClass('u-hidden');
      $addressModal.find('.js-automated-recipient-address-text').removeClass('u-hidden');
      $addressModal.find('.js-edit-address').removeClass('u-hidden');
      if (cityId !== data.city_id) {
        addressActions.setDistrictSelect(data.city_id);
        cityId = data.city_id;
        $('.js-address-city-auto').val(cityId);
      }

      $addressModal.find('.js-modal-search-field').addClass('u-hidden')
      $addressModal.find('.js-automated-recipient-address-text')
        .find('span')
        .text(data.address)
      ;
      if ($addressModal.find('.js-manual-recipient-address').hasClass('u-hidden')) {
        $addressModal.find('.js-address-address').val(data.address)
      }
      $addressModal.find('.js-automatic-address').val(data.address)
      $addressModal.find('.js-automated-recipient-address-text')
        .parent().removeClass('u-hidden')
      ;
      $addressForm.removeClass('u-hidden');
    });

  },
  onEditAddressClick($addressModal) {
    var $addressForm = $('#add-edit-address-form')
    $addressModal.on('click', '.js-edit-address', function() {
      $addressModal.find('.js-automated-recipient-address-text').parent().hide();
      $addressModal.find('.js-text-address-label').hide();
      $addressForm.find('.js-manual-recipient-address').removeClass('u-hidden');
    });
  },
  onChangeReverseAddressInProgress($addressModal) {
    $(document).on('changeReverseAddressInProgress', function () {
      $addressModal.find('.js-automated-recipient-address-text').parent().removeClass('u-hidden');
      $addressModal.find('.js-automated-recipient-address-text').addClass('u-hidden');
      $addressModal.find('.js-modal-search-field').addClass('u-hidden');
      $addressModal.find('.js-edit-address').addClass('u-hidden');
      $addressModal.find('.js-loading-animation').removeClass('u-hidden');
    });
  },
  setDistrictSelect(cityId) {
    var $addressForm = $('#add-edit-address-form')
    var $districtSelector = $addressForm.find('.js-select-district');

    Services.ajaxGETRequestJSON(
      '/ajax/city/districts/' + cityId,
      null,
      function (data) {
        if (data.length !== 0) {
          $('.js-district-wrapper').show();
        } else {
          $('.js-district-wrapper').hide();
          $districtSelector.children('select .js-not-empty').remove();
          $districtSelector.selectric('refresh');
        }

        $districtSelector.children('select .js-not-empty').remove();
        $.each(data, function (index, district) {
          $('<option>').val(district.id).text(district.name).addClass('js-not-empty').appendTo($districtSelector);
        });

        if (addressActions.selectedDistrictId > 0) {
          $districtSelector.val(addressActions.selectedDistrictId);
        }

        $districtSelector.selectric('refresh').change();

        $(document).trigger(jQuery.Event('mapInit'));
      },
      function (data) {
        console.log(data.errors);
      }
    );

  },
};

$(function () {
  addressActions.init();
});


/*[PATH @digikala/supernova-digikala-desktop/assets/local/js/controllers/addressController/addAddressAction.js]*/
var IndexAction = {

  init: function () {
    if(isModuleActive('new_address_modal')) {
      this.initAddressModal();
    } else {
      this.initSelects();
      this.initUpdateCities();
      this.initUpdateDistricts();
      this.initForeignerSwitch();
      this.initForm();
      MapActions.initGoogleMap(this, 'map_add');
    }
  },

  initSelects: function () {
    $('.js-ui-select').selectric();
  },

  initUpdateCities: function () {
    var stateSelector = $('.js-select-state');
    $(document).on('change', '.js-select-state', function () {
      var $thiz = $(this);
      var stateId = $thiz.val();
      var $citySelector = $('.js-select-city');

      Services.ajaxGETRequestJSON(
        '/ajax/state/cities/' + stateId,
        null,
        function (data) {
          $citySelector.children('select .js-not-empty').remove();
          $.each(data, function (index, city) {
            $('<option>').val(city.id).text(city.name).addClass('js-not-empty').appendTo($citySelector);
          });
          $citySelector.selectric('refresh');
          $thiz.selectric('refresh');
          $('.js-district-wrapper').hide();
        },
        function (data) {
          console.log(data.errors);
        }
      );
    });

    if (stateSelector.val()) {
      stateSelector.change();
    }
  },

  initUpdateDistricts: function () {
    $('.js-district-wrapper').hide();
    $(document).on('change', '.js-select-city', function () {
      var $thiz = $(this);
      var cityId = $thiz.val();
      var $districtSelector = $('.js-select-district');

      Services.ajaxGETRequestJSON(
        '/ajax/city/districts/' + cityId,
        null,
        function (data) {
          if (data.length !== 0) {
            $('.js-district-wrapper').show();
          } else {
            $('.js-district-wrapper').hide();
            $districtSelector.children('select .js-not-empty').remove();
            $districtSelector.selectric('refresh');
          }

          $districtSelector.children('select .js-not-empty').remove();
          $.each(data, function (index, district) {
            $('<option>').val(district.id).text(district.name).addClass('js-not-empty').appendTo($districtSelector);
          });
          $thiz.selectric('refresh');
          $districtSelector.selectric('refresh');
        },
        function (data) {
          console.log(data.errors);
        }
      );
    });
    $(document).on('change', '.js-select-district', function () {
      $(this).selectric('refresh');
    });
  },

  initForeignerSwitch: function () {
    $('.js-foreigner-check').change(function () {
      if ($(this).is(':checked')) {
        $('.js-foreigner').find('input').attr('disabled', true).addClass('disabled');
      } else {
        $('.js-foreigner').find('input').attr('disabled', false).removeClass('disabled');
      }
    });

    $('.js-foreigner-check').change();
  },

  initForm: function () {
    var $form = $('#addAddressForm');

    $form.validate({
      rules: {
        'address[first_name]': {
          required: true,
          maxlength: 255
        },
        'address[last_name]': {
          required: true,
          maxlength: 255
        },
        'address[national_identity_number]': {
          required: true,
          digits: true,
          minlength: 10,
          maxlength: 10,
          national_identity_number: true
        },
        'address[full_name]': {
          required: true,
          rangelength: [3, 255]
        },
        'address[mobile_phone]': {
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11,
          mobile_phone: true
          // moved from custom validation
        },
        'address[phone]': {
          required: false,
          digits: true,
          minlength: 11,
          maxlength: 11
        },
        'address[state_id]': {
          required: true
        },
        'address[city_id]': {
          required: true
        },
        'address[district_id]': {
          required: {
            depends: function (element) {
              return $('.js-district-wrapper').is(':visible')
            }
          }
        },
        'address[post_code]': {
          required: true,
          digits: true,
          rangelength: [10, 10]
        },
        'address[address]': {
          required: true,
          minlength: 10,
          maxlength: 350,
          notOnlyNumber: true,
          notEmailAddress: true
        },
        'address[bld_num]': {
          required: true,
          maxlength: 10
        }
      },
      messages: {
        'address[first_name]': {
          'required': 'نام خود را وارد نمایید',
          'maxlength': 'نام وارد شده باید کمتر از ۳۰ حرف باشد'
        },
        'address[last_name]': {
          'required': 'نام خانوادگی را وارد نمایید',
          'maxlength': 'نام خانوادگی طولانی است'
        },
        'address[national_identity_number]': {
          'required': 'کد ملی نامعتبر است',
          'digits': 'کد ملی را درست وارد نمایید',
          'minlength': 'کد ملی را کامل وارد نمایید',
          'maxlength': 'کد ملی را درست وارد نمایید',
          'national_identity_number': 'کد ملی نامعتبر است'
        },
        'address[full_name]': {
          'required': 'فیلد الزامی است',
          'rangelength': 'نام را درست وارد نمایید'
        },
        'address[mobile_phone]': {
          'required': 'فیلد الزامی است',
          'digits': 'شماره موبایل را درست وارد نمایید',
          'minlength': 'شماره موبایل را کامل وارد نمایید',
          'maxlength': 'شماره موبایل را درست وارد نمایید',
          'mobile_phone': 'شماره موبایل نامعتبر است'
        },
        'address[phone]': {
          'digits': 'شماره تلفن ثابت را درست وارد نمایید',
          'minlength': 'شماره تلفن ثابت را کامل وارد نمایید',
          'maxlength': 'شماره تلفن ثابت را درست وارد نمایید',
          'landline_phone': 'شماره تلفن ثابت نامعتبر است'
        },
        'address[state_id]': {
          'required': 'فیلد الزامی است'
        },
        'address[city_id]': {
          'required': 'فیلد الزامی است'
        },
        'address[district_id]': {
          'required': 'فیلد الزامی است'
        },
        'address[post_code]': {
          'required': 'کد پستی الزامی است',
          'digits': 'فقط مقدار عددی مجاز است',
          'rangelength': 'کد پستی را درست وارد نمایید'
        },
        'address[address]': {
          'required': 'فیلد الزامی است',
          'minlength': 'آدرس وارد شده کوتاه است',
          'maxlength': 'لطفا آدرس را کوتاه‌تر وارد نمایید',
          'notOnlyNumber': 'آدرس وارد شده نمی تواند فقط شامل اعداد باشد',
          'notEmailAddress': 'آدرس نمی تواند شامل ایمیل باشد'
        },
        'address[bld_num]': {
          'required': 'پلاک را وارد نمایید',
          'maxlength': 'شماره پلاک را درست وارد نمایید'
        }
      }
    }).showBackendErrors();
  },

  initAddressModal: function () {
    var addressModalDom = $('[data-remodal-id=add-edit-address]');
    var addressModal = addressModalDom.remodal();
    var form = $('#add-edit-address-form');
    $('.js-add-address-btn').click();
    addressModalDom.find('.c-modal__close').remove();

    if(window.jsFormErrors && window.jsFormErrors.address['address[point]']) {
      DKToast(window.jsFormErrors.address['address[point]']);
      form.append('<input type="hidden" name="address[novalidate_point]" value=true />');
    }

    $(document).on('closed', addressModal, function () {
      addressModal.open();
    });

    form.off();
    $('.js-submit-btn').on('click', function (e) {
      e.preventDefault();
      if(form.valid()) {
        form.submit();
      }
    })
  },
};

$(function () {
  IndexAction.init();
});
