import DownloadBox from "./DownloadBox.vue";
import {Meta, StoryFn} from "@storybook/vue3";
import {DownloadData} from "../../Data/DownloadData";

export default {
	title: "Piece/Download Box",
	component: DownloadBox
} as Meta<typeof DownloadBox>;

const Template: StoryFn<typeof DownloadBox> = (args: { download: DownloadData }) => ({
	components: { DownloadBox },
	setup() {
		return { args };
	},
	template: "<DownloadBox v-bind=\"args\" />"
});

export const Default = Template.bind({});
Default.args = {
	download: {
		name: "Nun singet und seid froh",
		pdfUrl: "https://web.archive.org/web/20220528113311im_/https://nun-singet-und-seid-froh.info/storage/sheets/8 Also hat Gott die Welt geliebet (Distler, Hugo).pdf",
		midiUrl: "https://web.archive.org/web/20220528113311im_/https://nun-singet-und-seid-froh.info/storage/sheets/8 Also hat Gott die Welt geliebet (Distler, Hugo).zip",
		srcUrl: "https://github.com/nun-singet-und-seid-froh/nun-singet-und-seid-froh/tree/master/scores/In_dulci_jubilo/In_dulci_jubilo_(Praetorius%2C_Michael_%5BMS_2_V%5D)"
	}
};
