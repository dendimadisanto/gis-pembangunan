import Map from '../components/Map.vue';
import SumberDana from '../components/SumberDana/Main';
import FormAddDana from '../components/SumberDana/FormAdd';

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
        name: 'form-dana',
        path: '/form-add-dana',
        component: FormAddDana
    },
]

export default routes;