require('./bootstrap');

import Vue from 'vue'

new Vue({
    el: '#app',
    data() {
        return {
            url: '/search',
            search: '',
            announcements: [],
            loading: false,
        }
    },
    watch: {
        search(value) {
            if (value.length > 2) {
                this.searchAnnouncements()
            } else {
                this.announcements = []
            }
        }
    },
    methods: {
        searchAnnouncements() {
            this.loading = true
            window.axios.post(this.url, {search: this.search}).then((response) => {
                if (response.data) {
                    this.announcements = response.data
                }
            })
            this.loading = false
        },
    },
})
