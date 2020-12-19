<template>
    <div :class="this.classSnackbar + ((title || subtitle) ? ' bandwagon-show' : '')">
        <div :class="this.classMessage">
            <p :class="this.classTitle">{{ title }}</p>
            <p :class="this.classSubtitle">{{ subtitle }}</p>
            <p :class="this.classTime">{{ timeAgo() }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    props: {
        classSnackbar: {
            type: String,
            default: 'bandwagon-snackbar'
        },
        classMessage: {
            type: String,
            default: 'bandwagon-message'
        },
        classTitle: {
            type: String,
            default: 'bandwagon-text bandwagon-title'
        },
        classSubtitle: {
            type: String,
            default: 'bandwagon-text bandwagon-subtitle'
        },
        classTime: {
            type: String,
            default: 'bandwagon-text bandwagon-time'
        }
    },
    data: function () {
        return {
            title: null,
            subtitle: null,
            since: null
        }
    },
    mounted() {
        setInterval(this.loadMessage, Bandwagon.poll * 1000);
        this.loadMessage();
    },
    methods: {
        clearMessage() {
            this.title = null
            this.subtitle = null
        },
        loadMessage() {
            axios.get(Bandwagon.path + '/bandwagon-api/event?since=' + this.since)
                .then(response => {
                    if (response.data) {
                        this.title = response.data.title
                        this.subtitle = response.data.subtitle
                        this.since = response.data.event_at
                        setTimeout(this.clearMessage, Bandwagon.display * 1000);
                    }
                })
        },
        timeAgo() {
            var msPerMinute = 60 * 1000;
            var msPerHour = msPerMinute * 60;
            var msPerDay = msPerHour * 24;
            var msPerMonth = msPerDay * 30;
            var msPerYear = msPerDay * 365;

            var elapsed = Date.now() - (this.since * 1000);

            if (elapsed < msPerMinute) {
                return Math.round(elapsed/1000) + ' seconds ago';   
            }

            else if (elapsed < msPerHour) {
                return Math.round(elapsed/msPerMinute) + ' minutes ago';   
            }

            else if (elapsed < msPerDay ) {
                return Math.round(elapsed/msPerHour ) + ' hours ago';   
            }

            else if (elapsed < msPerMonth) {
                return 'approximately ' + Math.round(elapsed/msPerDay) + ' days ago';   
            }

            else if (elapsed < msPerYear) {
                return 'approximately ' + Math.round(elapsed/msPerMonth) + ' months ago';   
            }

            else {
                return 'approximately ' + Math.round(elapsed/msPerYear ) + ' years ago';   
            }
        }
    }
}
</script>
