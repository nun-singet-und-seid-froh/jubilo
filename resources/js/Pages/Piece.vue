<template>
	<Title :title="piece.title"/>
	<div class="flex w-full p-2 space-x-2">
		<div class="grow-0 w-1/2">
			<div class="flex space-x-2">
				<PersonBox :person="composer"/>
				<PersonBox :person="lyricist"/>
			</div>
			<DownloadBox :download="piece.download" />
		</div>
		<div class="flex shadow-md w-1/2" style="height: 800px">
			<PdfBox :download="piece.download"/>
		</div>
	</div>
</template>

<script setup lang="ts">
import {defineProps, Ref, ref, UnwrapRef} from "vue";
import Title from "../Components/Piece/Title.vue";
import PersonBox from "../Components/Piece/PersonBox.vue";
import DownloadBox from "../Components/Piece/DownloadBox.vue";
import PdfBox from "../Components/Piece/PdfBox.vue";
import {ComposerData, LyricistData, PersonData} from "../Data/PersonData";
import {DownloadData} from "../Data/DownloadData";

const props = defineProps<{
	piece: PieceData
}>()

const composer: Ref<UnwrapRef<ComposerData>> = ref({
	...props.piece.composer,
	type: 'composer'
});

const lyricist: Ref<UnwrapRef<LyricistData>> = ref({
	...props.piece.lyricist,
	type: 'lyricist'
});

interface PieceMetaData {

}

interface PieceData {
	title: string,
	composer?: PersonData,
	lyricist?: PersonData,
	download: DownloadData,
	pieceMetaData: PieceMetaData
}
</script>

<script lang="ts">
import MainLayout from "../Layouts/MainLayout.vue";
export default {
	name: "Piece",
	layout: MainLayout
}
</script>
