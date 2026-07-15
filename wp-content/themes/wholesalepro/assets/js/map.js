'use strict';

const WPMap = {

  map:     null,
  markers: [],

  init() {
    const apiKey = (typeof wholesalePro !== 'undefined') ? wholesalePro.mapsKey : '';
    if (!apiKey) return;

    const script  = document.createElement('script');
    script.src    = 'https://maps.googleapis.com/maps/api/js?key=' + encodeURIComponent(apiKey) + '&callback=WPMap.initMap&libraries=marker';
    script.defer  = true;
    script.async  = true;
    document.head.appendChild(script);
  },

  initMap() {
    const mapEl = document.getElementById('coverage-map');
    if (!mapEl) return;

    // Remove placeholder content
    mapEl.innerHTML = '';
    mapEl.style.minHeight = '450px';

    // Navy-themed map styles
    const mapStyles = [
      { elementType: 'geometry',            stylers: [{ color: '#1d2c4d' }] },
      { elementType: 'labels.text.fill',    stylers: [{ color: '#8ec3b9' }] },
      { elementType: 'labels.text.stroke',  stylers: [{ color: '#1a3646' }] },
      { featureType: 'administrative.country', elementType: 'geometry.stroke', stylers: [{ color: '#4b6878' }] },
      { featureType: 'administrative.land_parcel', elementType: 'labels.text.fill', stylers: [{ color: '#64779e' }] },
      { featureType: 'administrative.province', elementType: 'geometry.stroke', stylers: [{ color: '#4b6878' }] },
      { featureType: 'landscape.man_made',  elementType: 'geometry.stroke', stylers: [{ color: '#334e87' }] },
      { featureType: 'landscape.natural',   elementType: 'geometry', stylers: [{ color: '#023e58' }] },
      { featureType: 'poi',                 elementType: 'geometry', stylers: [{ color: '#283d6a' }] },
      { featureType: 'poi', elementType: 'labels.text.fill', stylers: [{ color: '#6f9ba5' }] },
      { featureType: 'poi', elementType: 'labels.text.stroke', stylers: [{ color: '#1d2c4d' }] },
      { featureType: 'poi.park',            elementType: 'geometry.fill', stylers: [{ color: '#023e58' }] },
      { featureType: 'poi.park',            elementType: 'labels.text.fill', stylers: [{ color: '#3C7680' }] },
      { featureType: 'road',                elementType: 'geometry', stylers: [{ color: '#304a7d' }] },
      { featureType: 'road',                elementType: 'labels.text.fill', stylers: [{ color: '#98a5be' }] },
      { featureType: 'road',                elementType: 'labels.text.stroke', stylers: [{ color: '#1d2c4d' }] },
      { featureType: 'road.highway',        elementType: 'geometry', stylers: [{ color: '#2c6675' }] },
      { featureType: 'road.highway',        elementType: 'geometry.stroke', stylers: [{ color: '#255763' }] },
      { featureType: 'road.highway',        elementType: 'labels.text.fill', stylers: [{ color: '#b0d5ce' }] },
      { featureType: 'road.highway',        elementType: 'labels.text.stroke', stylers: [{ color: '#023747' }] },
      { featureType: 'transit',             elementType: 'labels.text.fill', stylers: [{ color: '#98a5be' }] },
      { featureType: 'transit',             elementType: 'labels.text.stroke', stylers: [{ color: '#1d2c4d' }] },
      { featureType: 'transit.line',        elementType: 'geometry.fill', stylers: [{ color: '#283d6a' }] },
      { featureType: 'transit.station',     elementType: 'geometry', stylers: [{ color: '#3a4762' }] },
      { featureType: 'water',               elementType: 'geometry', stylers: [{ color: '#0e1626' }] },
      { featureType: 'water',               elementType: 'labels.text.fill', stylers: [{ color: '#4e6d70' }] },
    ];

    this.map = new google.maps.Map(mapEl, {
      zoom:              4,
      center:            { lat: 39.5, lng: -98.35 },
      styles:            mapStyles,
      mapTypeControl:    false,
      streetViewControl: false,
      fullscreenControl: false,
      zoomControl:       true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.RIGHT_BOTTOM,
      },
      restriction: {
        latLngBounds: { north: 49.5, south: 24.0, east: -66.5, west: -125.0 },
        strictBounds: false,
      },
    });

    // Add property markers if map data is available
    const mapDataEl = document.getElementById('wp-map-data');
    if (mapDataEl) {
      let properties = [];
      try { properties = JSON.parse(mapDataEl.textContent); } catch (_) {}
      if (properties.length) {
        this.addPropertyMarkers(properties);
      }
    }

    // Add national coverage overlay label
    this.addCoverageLabel();
  },

  addPropertyMarkers(properties) {
    if (!this.map) return;
    properties.forEach(prop => {
      if (!prop.lat || !prop.lng) return;

      const marker = new google.maps.Marker({
        position: { lat: parseFloat(prop.lat), lng: parseFloat(prop.lng) },
        map:      this.map,
        title:    prop.title,
        icon: {
          path:        google.maps.SymbolPath.CIRCLE,
          scale:       8,
          fillColor:   '#F4A261',
          fillOpacity: 1,
          strokeColor: '#1B2B4B',
          strokeWeight: 2,
        },
      });

      const infoWindow = new google.maps.InfoWindow({
        content: `
          <div style="font-family:sans-serif;max-width:220px;padding:4px;">
            <strong style="color:#1B2B4B">${prop.title}</strong><br>
            ${prop.price ? '<span style="color:#E63946;font-weight:700">' + prop.price + '</span>' : ''}
            ${prop.profit ? '<br><span style="color:#2D6A4F">Profit: ' + prop.profit + '</span>' : ''}
            <br><a href="${prop.url}" style="color:#1B2B4B;font-size:0.85rem">View Deal →</a>
          </div>`,
      });

      marker.addListener('click', () => {
        this.markers.forEach(m => m.iw?.close());
        infoWindow.open(this.map, marker);
      });

      marker.iw = infoWindow;
      this.markers.push(marker);
    });
  },

  addCoverageLabel() {
    if (!this.map) return;
    const labelDiv   = document.createElement('div');
    labelDiv.style.cssText = 'background:rgba(27,43,75,0.85);color:#F4A261;padding:8px 16px;border-radius:4px;font-weight:700;font-size:14px;margin:10px;';
    labelDiv.textContent   = '🏠 All 50 States Covered';
    this.map.controls[google.maps.ControlPosition.TOP_CENTER].push(labelDiv);
  },
};

window.WPMap = WPMap;

document.addEventListener('DOMContentLoaded', () => WPMap.init());
