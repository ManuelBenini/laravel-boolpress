
// Istruzioni rotte vue

// Importo vue
import Vue from 'vue';

// Importo il router
import VueRouter from 'vue-router';

// Dico a Vue di usare VueRouter
Vue.use(VueRouter);

// Importo componenti
    import HomeComp from './components/pages/HomeComp.vue';
    import ContactsComp from './components/pages/ContactsComp.vue';
    import BlogComp from './components/pages/BlogComp.vue';
    import AboutComp from './components/pages/AboutComp.vue';
//


const router = new VueRouter({
    // Per accedere alla cronologia dell'utente
    mode: 'history',

    // Per cambiare nome alla classe attiva, che di default è router-link-exact-active
    linkExactActiveClass: 'active',
    routes:[
        {
            path: '/',
            name: 'home',
            component: HomeComp
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: AboutComp
        },
        {
            path: '/blog',
            name: 'blog',
            component: BlogComp
        },
        {
            path: '/contatti',
            name: 'contacts',
            component: ContactsComp
        }
    ]
})

// Lo esporto per importarlo poi dentro front.js che inizializza vue
export default router;
