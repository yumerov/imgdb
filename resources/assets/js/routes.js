import Home from './components/mains/Home'
import ImagesIndex from './components/mains/images/Index'
import ImagesShow from './components/mains/images/Show'
import ImagesCreate from './components/mains/images/Create'
import ImagesEdit from './components/mains/images/Edit'

const routes = [
    { path: '/', component: Home },
    { path: '/images', component: ImagesIndex },
    { path: '/images/:slug', component: ImagesShow },
    { path: '/images/create', component: ImagesCreate },
    { path: '/images/:slug/edit', component: ImagesEdit },
];

export default routes;