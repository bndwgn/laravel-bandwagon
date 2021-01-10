<template>
    <div :class="this.classSnackbar + showClass()">
        <div :class="this.classMessage">
            <component id="bandwagon-link" :is="this.url?'a':'span'" :href="this.url || ''">
                <p :class="this.classTitle">{{ title }}</p>
                <p :class="this.classSubtitle">{{ subtitle }}</p>
                <p :class="this.classTime">{{ timeAgo() }}</p>
            </component>
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
            since: null,
            url: null,
        }
    },
    mounted() {
        if (Bandwagon.enabled) {
            setTimeout(() => {
                setInterval(this.loadMessage, Bandwagon.poll * 1000);
                this.loadMessage();
            }, Bandwagon.delay * 1000);
        }
    },
    methods: {
        clearMessage() {
            this.title = null
            this.subtitle = null
        },
        getPath() {
            let path = Bandwagon.path + '/bandwagon-api/event';
            if (this.since) {
                path += '?since=' + this.since;
            }
            return path;
        },
        loadMessage() {
            axios.get(this.getPath())
                .then(response => {
                    if (response.data) {
                        this.title = response.data.title
                        this.subtitle = response.data.subtitle
                        this.since = response.data.event_at
                        this.url = response.data.url
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
                let result = Math.round(elapsed/1000);
                let pluralString = this.pluralString(result);
                return  `${result} second${pluralString} ago`;   
            } else if (elapsed < msPerHour) {
                let result = Math.round(elapsed/msPerMinute);
                let pluralString = this.pluralString(result);
                return `${result} minute${pluralString} ago`;   
            } else if (elapsed < msPerDay ) {
                let result = Math.round(elapsed/msPerHour);
                let pluralString = this.pluralString(result);
                return `${result} hour${pluralString} ago`;   
            } else if (elapsed < msPerMonth) {
                let result = Math.round(elapsed/msPerDay);
                let pluralString = this.pluralString(result);
                return `approximately ${result} day${pluralString} ago`;   
            } else if (elapsed < msPerYear) {
                let result = Math.round(elapsed/msPerMonth);
                let pluralString = this.pluralString(result);
                return `approximately ${result} month${pluralString} ago`;   
            } else {
                let result = Math.round(elapsed/msPerYear);
                let pluralString = this.pluralString(result);
                return `approximately ${result} year${pluralString} ago`;   
            }
        },
        pluralString(num) {
            return num > 1 ? 's' : '';
        },
        showClass() {
            return (this.title || this.subtitle) ? ' bandwagon-show' : '';
        }
    }
}
</script>
