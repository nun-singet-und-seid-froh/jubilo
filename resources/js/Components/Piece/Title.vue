<template>
	<div class="text-center p-4">
		<h1 v-text="title" class="text-4xl"/>
	</div>
</template>

<script setup lang="ts">
import {defineProps} from "vue"

defineProps<{
	title: string
}>();
</script>
