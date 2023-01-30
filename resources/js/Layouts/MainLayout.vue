<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
	title: String
})
</script>

<template>
	<Head>
		<title v-text="title" />
	</Head>
	<slot/>
</template>
