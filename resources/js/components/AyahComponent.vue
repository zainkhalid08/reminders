<template>
    <div class="text-center">
	    <blockquote class="blockquote">"<slot></slot>"</blockquote>
		<blockquote class="blockquote-footer text-right"><cite>QURAN {{ reference ? showReference() : '' | capitalize }}</cite></blockquote>
    </div>
</template>

<script>
    export default {
        props: ['rfr'],
        methods : {
            showReference() {
                return '('+ this.reference + ')';
            }
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.toUpperCase()
            }
        },
        data() {
            return {
                reference : this.rfr,
            };
        }
    }
</script>
