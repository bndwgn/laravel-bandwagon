import Vue from 'vue';
import BandwagonRenderer from './BandwagonRenderer'

Vue.component('bandwagon-renderer', BandwagonRenderer);

new Vue({
    el: '#bandwagon',
});