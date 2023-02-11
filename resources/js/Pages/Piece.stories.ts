import Piece from './Piece.vue'
import {Meta, StoryFn} from "@storybook/vue3";

export default {
	/* 👇 The title prop is optional.
	 * See https://storybook.js.org/docs/vue/configure/overview#configure-story-loading
	 * to learn how to generate automatic titles
	 */
	title: 'Piece',
	component: Piece,
} as Meta<typeof Piece>;

const Template: StoryFn<typeof Piece> = (args) => ({
	components: { Piece },
	setup() {
		return { args };
	},
	template: '<Piece v-bind="args" />',
});

export const FullPiece = Template.bind({});
FullPiece.args = {
	piece: {
		title: 'In Dulci Jubilo'
	}
}
