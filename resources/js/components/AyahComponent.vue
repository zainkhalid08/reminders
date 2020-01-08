<template>
    <div class="text-center">
	    <blockquote class="blockquote">&#8220;<slot></slot>&#8221;</blockquote>
		<blockquote class="blockquote-footer text-right"><cite>QURAN {{ reference ? showReference() : '' | capitalize }}</cite></blockquote>
    </div>
</template>

<script>
    export default {
        props: ['ayah'],
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
                reference : this.ayah,
            };
        }
    }
</script>
