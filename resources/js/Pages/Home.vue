<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
	canLogin: boolean
	canRegister: boolean
	laravelVersion: string
	phpVersion: string
}>();
</script>

<script lang="ts">
import MainLayout from "../Layouts/MainLayout.vue";
export default {
	layout: MainLayout
}
</script>

<template>
	<div class="items-center">
		<h1 class="text-2xl md:text-5xl xl:text-7xl p-5 pt-6 text-center">Nun singet und seid froh</h1>
		<div class="md:text-xl xl:text-3xl text-center"><p>Nun singet und seid froh ist eine freie Edition von Weihnachtsliedern für Chor a capella. <Link :href="route('catalogue')">Mehr...</Link></p></div>
		<svg class="w-1/2 mx-auto fill-prussian-700" viewBox="0 0 1334 1330">
			<use xlink:href="logo.svg#logo-svg" />
		</svg>
	</div>
</template>
