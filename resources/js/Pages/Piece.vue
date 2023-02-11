<template>
	<h1 v-text="piece.title" class="text-center text-4xl" />
	<Link href="/">{{ $t('piece.report.erratum') }}</Link>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import { Link } from "@inertiajs/vue3";

interface PersonData {
	personType: 'composer' | 'lyricist',
	name: string,
	dateOfBirth: string,
	died: string

}
interface ComposerData extends PersonData {
	personType: 'composer'
}

interface LyricistData extends PersonData {
	personType: 'lyricist'
}

interface DownloadData {

}

interface PieceMetaData {

}

interface PieceData {
	title: string,
	composerData?: ComposerData,
	lyricistData?: LyricistData,
	downloadData: DownloadData,
	pieceMetaData: PieceMetaData
}

defineProps<{
	piece: PieceData
}>()
</script>

<script lang="ts">
import MainLayout from "../Layouts/MainLayout.vue";
export default {
	name: "Piece",
	layout: MainLayout
}
</script>
