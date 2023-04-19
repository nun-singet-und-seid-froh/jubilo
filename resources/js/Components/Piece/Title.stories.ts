import Title from "./Title.vue";
import {Meta, StoryFn} from "@storybook/vue3";

export default {
	title: "Piece/Title",
	component: Title
} as Meta<typeof Title>;

const Template: StoryFn<typeof Title> = (args: {title: string }) => ({
	components: { Title},
	setup() {
		return { args };
	},
	template: "<Title v-bind=\"args\" />"
});

export const Default = Template.bind({});
Default.args = {
	title: "In Dulci Jubilo"
}

export const Ligature = Template.bind({});
Ligature.args = {
	title: "Es ist der Herr"
}
