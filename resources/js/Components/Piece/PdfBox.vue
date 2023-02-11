<template>
	<div class="flex w-full">
		<iframe class="w-full grow-1" :src="download.pdfUrl + '#page=2,zoom=FitV'" :title="download.name"/>
	</div>
</template>

<script setup lang="ts">
import {defineProps} from "vue";
import { DownloadData } from "../../Data/DownloadData";
defineProps<{
	download: DownloadData
}>();
</script>
