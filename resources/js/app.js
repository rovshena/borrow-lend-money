require('./bootstrap');

import Vue from 'vue'

const searchUrl = window.searchApiUrl

new Vue({
    el: '#app',
    data() {
        return {
            announcements: [],
            cities: [],
        }
    },
    methods: {
        searchAnnouncements: _.debounce(function (e) {
            if (e.target.value.length) {
                axios.post(searchUrl, {search: e.target.value}).then((response) => {
                    if (response.data) {
                        this.announcements = response.data
                    }
                })
            } else {
                this.announcements = []
            }
        }, 1000),
        searchCities: _.debounce(function (e) {
            if (e.target.value.length) {
                axios.post(searchUrl, {search: e.target.value}).then((response) => {
                    if (response.data) {
                        this.cities = response.data
                    }
                })
            } else {
                this.cities = []
            }
        }, 1000)
    },
})
