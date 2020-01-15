<template>
    <span title="this piece of content starts at {{ this.min }} {{ suffixMin() }} {{ this.sec }} {{ suffixSec() }} of the video shared on this page.">{{ showTime() }}</span>
</template>

<script>
    export default {
        props: ['min', 'sec'],
        methods : {
            showTime() {
                return '@'+ this.min + ':'+ this.sec +'.';
            },
            suffixMin() {
                if (this.min > 1) {
                    return 'mins';
                } else {
                    return 'min';
                }
            },
            suffixSec() {
                if (this.sec > 1) {
                    return 'seconds';
                } else {
                    return 'second';
                }
            }
        },
        data() {
            return {
                min : this.min,
                sec : this.sec,
            };
        }
    }
</script>
