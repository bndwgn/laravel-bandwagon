<template>
    <div id="bandwagon-snackbar" :class="(title || subtitle) ? 'show' : null">
        <div class="bandwagon-message">
            <p class="bandwagon-text bandwagon-title">{{ title }}</p>
            <p class="bandwagon-text bandwagon-subtitle">{{ subtitle }}</p>
            <p class="bandwagon-text bandwagon-time">{{ timeDifference() }}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
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
        timeDifference() {
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
