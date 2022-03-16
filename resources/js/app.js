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
            timer: undefined,
        }
    },
    watch: {
        search(value) {
            clearTimeout(this.timer)
            if (value.length) {
                this.timer =setTimeout(() => {
                    this.searchAnnouncements()
                }, 1000)
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
