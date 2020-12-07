<template>
    <div id="bandwagon-snackbar" :class="(title || subtitle) ? 'show' : null">
        <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
            <div>
                <p class="text-left text-base text-gray-500">{{ title }}</p>
                <p class="text-left text-base text-gray-500">{{ subtitle }}</p>
                <p class="text-right text-sm text-gray-500">{{ timeDifference() }}</p>
            </div>
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
    props: {
        poll: Number,
        display: Number,
        prefix: String
    },
    methods: {
        clearMessage() {
            this.title = null
            this.subtitle = null
        },
        loadMessage() {
            axios.get(this.prefix + '/bandwagon-api/event?since=' + this.since)
                .then(response => {
                    if (response.data) {
                        this.title = response.data.title
                        this.subtitle = response.data.subtitle
                        this.since = response.data.event_at
                        setTimeout(this.clearProof, 30000);
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


//     data: function () {
//         return {
//             title: null,
//             subtitle: null,
//             since: null
//         }
//     },
//     props: {
//         refresh: Number,
//     },
//     mounted() {
//         setInterval(this.loadProof, this.refresh);
//         this.loadProof();
//     },
//     methods: {
//         clearProof() {
//             this.title = null
//             this.subtitle = null
//         },
//         loadProof() {
//             axios.get('/proofs?since=' + this.since)
//                 .then(response => {
//                     if (response.data) {
//                         this.title = response.data.title
//                         this.subtitle = response.data.subtitle
//                         this.since = response.data.created_at
//                         setTimeout(this.clearProof, 30000);
//                     }
//                 })
//         },
//         timeDifference() {
//             var msPerMinute = 60 * 1000;
//             var msPerHour = msPerMinute * 60;
//             var msPerDay = msPerHour * 24;
//             var msPerMonth = msPerDay * 30;
//             var msPerYear = msPerDay * 365;

//             var elapsed = Date.now() - (this.since * 1000);

//             if (elapsed < msPerMinute) {
//                 return Math.round(elapsed/1000) + ' seconds ago';   
//             }

//             else if (elapsed < msPerHour) {
//                 return Math.round(elapsed/msPerMinute) + ' minutes ago';   
//             }

//             else if (elapsed < msPerDay ) {
//                 return Math.round(elapsed/msPerHour ) + ' hours ago';   
//             }

//             else if (elapsed < msPerMonth) {
//                 return 'approximately ' + Math.round(elapsed/msPerDay) + ' days ago';   
//             }

//             else if (elapsed < msPerYear) {
//                 return 'approximately ' + Math.round(elapsed/msPerMonth) + ' months ago';   
//             }

//             else {
//                 return 'approximately ' + Math.round(elapsed/msPerYear ) + ' years ago';   
//             }
//         }
//     }
// }
</script>
