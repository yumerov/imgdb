import Home from './components/mains/Home'
import ImagesIndex from './components/mains/images/Index'
import ImagesShow from './components/mains/images/Show'
import ImagesCreate from './components/mains/images/Create'
import ImagesEdit from './components/mains/images/Edit'
import TagsIndex from './components/mains/tags/Index'
import TagsShow from './components/mains/tags/Show'
import TagsCreate from './components/mains/tags/Create'
import TagsEdit from './components/mains/tags/Edit'
import SearchTags from './components/mains/search/Tags'
import SearchImages from './components/mains/search/Images'

/**
 * @type {*[]}
 */
const routes = [
    { path: '/', component: Home },

    { path: '/images', component: ImagesIndex },
    { path: '/images/create', component: ImagesCreate },
    { path: '/images/:slug', component: ImagesShow },
    { path: '/images/:slug/edit', component: ImagesEdit },

    { path: '/tags', component: TagsIndex },
    { path: '/tags/create', component: TagsCreate },
    { path: '/tags/:slug', component: TagsShow },
    { path: '/tags/:slug/edit', component: TagsEdit },

    { path: '/search/tags', component: SearchTags },
    { path: '/search/images', component: SearchImages },
];

export default routes;