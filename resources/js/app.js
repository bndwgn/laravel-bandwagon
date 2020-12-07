import Vue from 'vue';

Vue.component('bandwagon-renderer', require('./BandwagonRenderer.vue').default);

new Vue({
    el: '#bandwagon',
});