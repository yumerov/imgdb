import Home from './components/mains/Home'
import ImagesIndex from './components/mains/images/Index'
import ImagesShow from './components/mains/images/Show'

const routes = [
    { path: '/', component: Home },
    { path: '/images', component: ImagesIndex },
    { path: '/images/:slug', component: ImagesShow },
];

export default routes;