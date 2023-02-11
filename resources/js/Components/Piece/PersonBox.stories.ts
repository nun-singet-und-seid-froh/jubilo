import PersonBox from "./PersonBox.vue";
import {Meta, StoryFn} from "@storybook/vue3";
import {ComposerData, PersonData} from "../../Data/PersonData";

export default {
	title: "PersonBox",
	component: PersonBox
} as Meta<typeof Button>;

const Template: StoryFn<typeof PersonBox> = (args: {person: PersonData }) => ({
	components: { PersonBox},
	setup() {
		return { args };
	},
	template: "<PersonBox v-bind=\"args\" />"
});

const composer: ComposerData = {
	type: "composer",
	name: "Johannes Brahms",
	born: ""
};

export const Composer = Template.bind({});
Composer.args = {
	person: composer
};
