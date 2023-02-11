<template>
	<Title :title="piece.title"/>
	<div class="flex w-full">
		<div class="grow-0 w-1/2">
			<div class="flex m-2 mr-1 ">
				<PersonBox :person="composer"/>
				<PersonBox :person="lyricist"/>
			</div>
		</div>
		<div class="flex shadow-md w-1/2 m-2 ml-1 p-2" style="height: 800px">
			<PdfBox :download="piece.download"/>
		</div>
	</div>
</template>

<script setup lang="ts">
import {defineProps, Ref, ref, UnwrapRef} from "vue";
import Title from "../Components/Piece/Title.vue";
import PersonBox from "../Components/Piece/PersonBox.vue";
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
