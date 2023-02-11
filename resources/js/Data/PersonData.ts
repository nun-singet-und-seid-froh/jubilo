export interface PersonData {
	type: "composer" | "lyricist",
	name?: string,
	born?: string,
	died?: string
}


export interface ComposerData extends PersonData {
	type: "composer"
}

export interface LyricistData extends PersonData {
	type: "lyricist"
}
