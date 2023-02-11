export interface PersonData {
	type: "composer" | "lyricist",
	name?: string,
	born?: string,
	died?: string
	imageUrl?: string
}


export interface ComposerData extends PersonData {
	type: "composer"
}

export interface LyricistData extends PersonData {
	type: "lyricist"
}
