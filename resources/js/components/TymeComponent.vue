<!-- This is used in post to tell at what time this piece of content is mentioned in the sermon eg. @1:44 -->
<!-- usage as <tyme min="2" sec="4"></tyme> or <tyme min=2 sec=4></tyme> -->
<template>
    <small :title="makeTitle()"><a href="" @click="playHere()">{{ showTime() }}</a></small>
</template>

<script>
    export default {
        props: ['min', 'sec'],
        methods : {
            showTime() {
                return '@'+ this.minute + ':'+ this.second +'.';
            },
            makeTitle() {
                return 'Present at '+ this.minute + ' min(s) ' + this.second + ' sec(s) ' +'of the video shared on this page.';
            },
            playHere() {
                event.preventDefault(); // to prevent scroll to top behaviour
                clearTimeout(timer);
                if (isNaN(this.minute) || isNaN(this.second)) return
                let seconds = (parseInt(this.minute) * 60) + parseInt(this.second);
                player.seekTo(seconds, true);
                player.playVideo();
                timer = setTimeout(pauseVideo, 19000); // Note: it'll play for a little less than this time, coz of buffering
            }
        },
        data() {
            return {
                minute : this.min,
                second : this.sec,
            };
        }
    }
</script>
