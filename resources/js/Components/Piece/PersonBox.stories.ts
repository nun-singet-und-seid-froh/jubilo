import PersonBox from "./PersonBox.vue";
import {Meta, StoryFn} from "@storybook/vue3";
import {PersonData} from "../../Data/PersonData";

export default {
	title: "Piece/Person Box",
	component: PersonBox
} as Meta<typeof PersonBox>;

const Template: StoryFn<typeof PersonBox> = (args: {person: PersonData }) => ({
	components: { PersonBox },
	setup() {
		return { args };
	},
	template: "<PersonBox v-bind=\"args\" />"
});

const composer = {
	type: "composer",
	name: "Johannes Brahms",
	born: "1833",
	died: "1897",
	imageUrl: "https://upload.wikimedia.org/wikipedia/commons/a/a2/Johannes_Brahms_portrait.jpg"
};

const lyricist = {
	type: "lyricist",
	name: "Matthias Claudius",
	born: "1740",
	died: "1815"
};

export const Composer = Template.bind({});
Composer.args = {
	person: composer
};

export const Lyricist = Template.bind({});
Lyricist.args = {
	person: lyricist
}
