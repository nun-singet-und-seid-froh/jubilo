<template>
	<Title :title="piece.title"/>
	<div class="flex w-full">
		<div class="grow-0 w-1/2">
			<div class="flex m-2 mr-1 ">
				<PersonBox :person="piece.composer ?? unknownComposer"/>
				<PersonBox :person="piece.lyricist ?? unknownLyricist"/>
			</div>
		</div>
		<div class="flex shadow-md w-1/2 m-2 ml-1 p-2" style="height: 800px">
			<PdfBox :download="piece.download"/>
		</div>
	</div>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import Title from "../Components/Piece/Title.vue";
import PersonBox from "../Components/Piece/PersonBox.vue";
import PdfBox from "../Components/Piece/PdfBox.vue";
import {PersonData} from "../Data/PersonData";
import {DownloadData} from "../Data/DownloadData";

interface ComposerData extends PersonData {
	type: 'composer'
}

interface LyricistData extends PersonData {
	type: 'lyricist'
}

const unknownComposer: ComposerData = {
	type: 'composer',
};

const unknownLyricist: LyricistData = {
	type: 'lyricist',
};

interface PieceMetaData {

}

interface PieceData {
	title: string,
	composer?: ComposerData,
	lyricist?: LyricistData,
	download: DownloadData,
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
