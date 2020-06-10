<template>
<div class="content">
    <div class="filter" style="margin:1rem">
        <div class="row">
            <div class="col-sm-2">
                Tahun
                <select v-model="tahun" @change="getKegiatan">
                    <option v-for=" i in 3" :value="new Date().getFullYear() - (3 - i)">{{new Date().getFullYear() - (3 - i)}}</option>
                    <option v-for=" i in 3" :value="new Date().getFullYear() + 1">{{new Date().getFullYear() + i}}</option>
                </select>
            </div>
            <div class="col-sm-8">
                 Sumber Dana
                   <select v-model="sumber_dana_id" @change="getKegiatan">
                        <option value="0">Semua</option>
                        <option v-for="(value, index) in sumberDana" :value="value.id">{{value.nama}}</option>
                    </select>
            </div>
        </div>
    </div>
    <div class="map">
      <l-map style="height: 560px; width: 100%" :zoom="zoom" :center="center">
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
        <l-marker  v-for="(item, index) in data" :lat-lng="[item['lat'],item['lng']]" :key="index" >
            <l-icon
                  :icon-size="dynamicSize"
                  :icon-anchor="dynamicAnchor"
                  :icon-url="baseURL + '/upload/marker/' + item['sumber_dana'].icon" >
          </l-icon>
            <l-popup>
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://i.pinimg.com/originals/43/a9/67/43a96748d7b52118930709194d381d6d.png" alt="Card image cap">
                <div class="card-body" style="text-align:center">
                   <button class="btn btn-primary">Detail</button>
                </div>
              </div>
            </l-popup>
        </l-marker>
      </l-map>
    </div>
</div>

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
      tahun:new Date().getFullYear(),
      data:[],
      baseURL:App.baseURL,
      url:'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZGVuZGkiLCJhIjoiY2thdnM4bzJsMTU4ZTJ1cGhvd3V6cGF4ZyJ9.XUd4BVBF12fVpfwUoWv0Hg',
      zoom: 15,
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
       marker:[],
       sumberDana:[],
       sumber_dana_id:0,
         iconSize: 64
    };
  },
  beforeMount(){
        this.getGeoJson();
        this.getKegiatan();
        this.getSumberDana();
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
              await axios.get(App.baseURL + '/get-data-gis',App.request)
                  .then(response =>{
                      if(response.data.success){
                        let json = JSON.parse(response.data.result.geojson);
                         this.geojson = json.features;
                      }
                       
                  }).catch(error=>{

                  });
                 
        },
        async getKegiatan(){
            let params = {};
            params.tahun = this.tahun;
            params.sumber_dana_id = this.sumber_dana_id;
            await axios.post(App.baseURL + '/get-gis-kegiatan', params,App.request).then(response=>{
                if(response.data.success){
                  this.data = response.data.result;
                }
            })
        },
        async getSumberDana(){
           await axios.get(App.baseURL + '/get-sumber-dana-all', App.request).then(response => {
                if(response.data.success){
                    this.sumberDana = response.data.results
                }
                else{
                     Swal.fire('Informasi', 'Ada Kesalahan Server' ,'error');
                }
            }).catch(error=>{
                 Swal.fire('Informasi', 'Ada Kesalahan Server' ,'error');
            });
        },
  }
}
</script>
