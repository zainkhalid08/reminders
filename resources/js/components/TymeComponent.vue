<!-- This is used in post to tell at what time this piece of content is mentioned in the sermon eg. @1:44 -->
<!-- usage as <tyme min="2" sec="4"></tyme> or <tyme min=2 sec=4></tyme> -->
<template>
    <small :title="makeTitle()">{{ showTime() }}</small>
</template>

<script>
    export default {
        props: ['min', 'sec'],
        methods : {
            showTime() {
                return '@'+ this.minute + ':'+ this.second +'.';
            },
            makeTitle() {
                return 'this piece of content starts at '+ this.minute + ' minute(s) ' + this.second + ' second(s) ' +'of the video shared on page.';
            },
        },
        data() {
            return {
                minute : this.min,
                second : this.sec,
            };
        }
    }
</script>
