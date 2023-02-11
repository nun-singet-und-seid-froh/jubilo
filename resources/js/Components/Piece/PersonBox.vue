<template>
<div class="shadow-md w-1/2 m-2 p-2">
	<h2 v-text="title" class="text-xl"/>
	<div v-text="person.name ?? 'Unbekannt'" />
</div>
</template>

<script setup lang="ts">
import {defineProps, ref} from "vue";
import {PersonData} from "../../Data/PersonData";
const props = defineProps<{
	person?: PersonData
}>();

const title = ref((props.person.type === "composer") ? "Komponist*in" : "Dichter*in");
</script>
