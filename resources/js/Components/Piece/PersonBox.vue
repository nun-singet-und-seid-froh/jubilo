<template>
<div class="shadow-md w-1/2 m-2 p-3">
	<h2 v-text="title" class="text-xl"/>
	<div v-text="person.name ?? 'Unbekannt'" />
	<span v-if="person.name && person.born">*{{person.born}}</span>
	<span v-if="person.name && person.born && person.died"> &ndash; </span>
	<span v-if="person.name && person.died">&#10013;{{person.died}}</span>
	<img v-if="person.name && person.imageUrl" :src="person.imageUrl" :alt="'Bild von ' + person.name" class="pt-2"/>
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
