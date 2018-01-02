import Home from './components/mains/Home'
import ImagesIndex from './components/mains/images/Index'
import ImagesShow from './components/mains/images/Show'
import ImagesCreate from './components/mains/images/Create'

const routes = [
    { path: '/', component: Home },
    { path: '/images', component: ImagesIndex },
    { path: '/images/create', component: ImagesCreate },
    { path: '/images/:slug', component: ImagesShow },
];

export default routes;