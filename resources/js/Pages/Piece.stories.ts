import Piece from './Piece.vue'
import {Meta, StoryFn} from '@storybook/vue3';

export default {
	/*
	 * See https://storybook.js.org/docs/vue/configure/overview#configure-story-loading
	 * to learn how to generate automatic titles
	 */
	title: 'Piece',
	component: Piece,
} as Meta<typeof Piece>;

export const FullPiece: StoryFn<typeof Piece> = () => ({
	components: { Piece },
	template: '<Piece />',
});
