import Map from '../components/Map.vue';
import SumberDana from '../components/SumberDana/Main';
import KegiatanFisik from '../components/KegiatanFisik/Main';
import FormKegiatan from '../components/KegiatanFisik/Form';

// membuat router
const routes = [
    {
        name: 'map',
        path: '/',
        component: Map
    },
    {
        name: 'sumber_dana',
        path: '/sumber-dana',
        component: SumberDana
    },
    {
        name: 'kegiatan_fisik',
        path: '/kegiatan_fisik',
        component: KegiatanFisik
    },
    {
        name: 'form_kegiatan',
        path: '/form-kegiatan/:id',
        component: FormKegiatan
    },
]

export default routes;