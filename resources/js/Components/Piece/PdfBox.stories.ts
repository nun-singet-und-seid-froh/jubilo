import PdfBox from "./PdfBox.vue";
import {Meta, StoryFn} from "@storybook/vue3";
import {DownloadData} from "../../Data/DownloadData";

export default {
	title: "Piece/Pdf Box",
	component: PdfBox
} as Meta<typeof PdfBox>;

const Template: StoryFn<typeof PdfBox> = (args: { download: DownloadData }) => ({
	components: { PdfBox },
	setup() {
		return { args };
	},
	template: "<PdfBox v-bind=\"args\" />"
});

export const Default = Template.bind({});
Default.args = {
	download: {
		name: "PdfBox name",
		pdfUrl: "https://web.archive.org/web/20220528113311im_/https://nun-singet-und-seid-froh.info/storage/sheets/8 Also hat Gott die Welt geliebet (Distler, Hugo).pdf"
	}
};
