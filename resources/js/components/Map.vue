<template>
<l-map style="height: 600px; width: 100%" :zoom="zoom" :center="center">
<l-control-layers position="topright"  ></l-control-layers>
<l-tile-layer
      v-for="tileProvider in tileProviders"
      :key="tileProvider.name"
      :name="tileProvider.name"
      :visible="tileProvider.visible"
      :url="tileProvider.url"
      :attribution="tileProvider.attribution"
      layer-type="base"/>
<l-geo-json :geojson="geojson"></l-geo-json>
<!-- <l-marker :lat-lng="center" :draggable="isdrag" v-on:drag="dragging"></l-marker> -->
<l-marker  v-for="(item, index) in marker" :lat-lng="marker[index]" :key="index" >
    <l-icon
          :icon-size="dynamicSize"
          :icon-anchor="dynamicAnchor"
          icon-url="https://img.icons8.com/material/4ac144/256/user-male.png" >
  </l-icon>
    <l-popup>
      <button class="btn btn-info">detail</button>
    </l-popup>
</l-marker>
</l-map>
</template>

<script>
import {LMap, LTileLayer, LControlLayers, LGeoJson, LMarker,LPopup, LIcon} from 'vue2-leaflet';

export default {
  components: {
    LMap,
    LTileLayer,
    LControlLayers,
    LGeoJson,
    LMarker,
    LPopup,
     LIcon
  },
  data () {
    return {
      url:'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGVuZGkiLCJhIjoiY2thdnM4bzJsMTU4ZTJ1cGhvd3V6cGF4ZyJ9.XUd4BVBF12fVpfwUoWv0Hg',
      zoom: 15,
      isdrag:true,
      center: [-7.898452568570932, 110.29196285286662],
      tileProviders: [
        {
          name: 'StreetMap',
          visible: true,
          attribution:
            '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            url:'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGVuZGkiLCJhIjoiY2thdnM4bzJsMTU4ZTJ1cGhvd3V6cGF4ZyJ9.XUd4BVBF12fVpfwUoWv0Hg',
        },
        {
          name: 'Satelite',
          visible: false,
         url:'https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGVuZGkiLCJhIjoiY2thdnM4bzJsMTU4ZTJ1cGhvd3V6cGF4ZyJ9.XUd4BVBF12fVpfwUoWv0Hg',
          attribution:
            'Map data: &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
        },
      ],
       geojson:[],
       marker:[ [-7.93493,110.481997],[-7.7795895,110.34770333]],
         iconSize: 64
    };
  },
  created(){
        this.getGeoJson();
        console.log(this.url);
  },
  computed: {
    dynamicSize () {
      return [this.iconSize, this.iconSize * 1.15];
    },
    dynamicAnchor () {
      return [this.iconSize / 2, this.iconSize * 1.15];
    }
  },
  methods:{
        async getGeoJson(){
              await axios.get('http://localhost:8000/get-data-gis')
                  .then(response =>{
                        this.geojson = response.data.features;
                        console.log(response);
                  }).catch(error=>{

                  });
                 
        },
        dragging(e){
          console.log(e);
        }
  }
}
</script>
