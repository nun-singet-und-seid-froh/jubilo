<template>
	<h2 v-text="title" class="text-xl w-full col-span-3"/>
</template>

<script setup lang="ts">
import {defineProps} from "vue";
const props = defineProps<{title: string}>();
</script>
