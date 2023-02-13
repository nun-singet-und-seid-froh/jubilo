<template>
	<div class="shadow-md grid grid-cols-3 p-3">
		<BoxTitle title="Downloads"/>
		<div class="col-span-1">PDF</div>
		<div class="col-span-2"><a :href="download.pdfUrl">{{ download.name }}.pdf</a></div>
		<div class="col-span-1">Übungs-MIDI</div>
		<div class="col-span-2"><a :href="download.midiUrl">{{ download.name }}.zip</a></div>
		<div class="col-span-1">Aufnahme</div>
		<!-- currently no recordings -->
		<div class="col-span-2">&mdash;</div>
		<div class="col-span-1">Quellcode</div>
		<div class="col-span-2"><a :href="download.srcUrl">auf github</a></div>
	</div>
</template>

<script setup lang="ts">
import BoxTitle from "./BoxTitle.vue";
import {DownloadData} from "../../Data/DownloadData";

const props = defineProps<{ download: DownloadData }>();
</script>
