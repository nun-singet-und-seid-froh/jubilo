<script setup>
import {Link, Head } from '@inertiajs/vue3';
import NavBar from "./Partials/NavBar.vue";

defineProps({
	title: String
})
</script>

<template>
	<Head>
		<title v-text="title" />
	</Head>
	<NavBar>
		<Link :href="route('home')"><i><img class="h-11 pl-1 pt-1 pb-1" src="icon.png" /></i></Link>
		<Link :href="route('admin')" class="h-12 py-3 text-xl pr-2">Admin</Link>
	</NavBar>
	<div class="container mx-auto">
		<slot/>
	</div>
</template>
