<template>
	<div class="flex w-full">
		<iframe class="w-full grow-1" :src="srcUrl" :title="download.name"/>
	</div>
</template>

<script setup lang="ts">
import {defineProps, ref} from "vue";
import { DownloadData } from "../../Data/DownloadData";
const props = defineProps<{
	download: DownloadData
}>();

const srcUrl = ref(props.download.pdfUrl + '#page=2,zoom=FitH');
</script>
