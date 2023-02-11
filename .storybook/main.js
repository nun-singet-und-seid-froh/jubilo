module.exports = {
	"typescript": {
		check: false,
		checkOptions: {},
		reactDocgen: 'react-docgen-typescript',
		reactDocgenTypescriptOptions: {
			shouldExtractLiteralValuesFromEnum: true,
			propFilter: (prop) => (prop.parent ? !/node_modules/.test(prop.parent.fileName) : true),
		},
	},
	"stories": [
		"../resources/js/**/*.stories.mdx",
		"../resources/js/**/*.stories.@(js|jsx|ts|tsx)"
	],
	"addons": [
		"@storybook/addon-links",
		"@storybook/addon-essentials",
		"@storybook/addon-interactions"
	],
	"framework": "@storybook/vue3",
	"core": {
		"builder": "@storybook/builder-vite"
	},
	"features": {
		"storyStoreV7": true
	}
}
