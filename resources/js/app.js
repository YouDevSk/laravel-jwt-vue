import './bootstrap';
import Vue from 'vue';
import filters from './filters';

import Routes from './routes'

import MainComponent from './views/MainComponent'
import LoginComponent from './views/LoginComponent'

const app = new Vue({
    el: '#app',
    router: Routes,
    components: {
        MainComponent,
        LoginComponent
    }
});
