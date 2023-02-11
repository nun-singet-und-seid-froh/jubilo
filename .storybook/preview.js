
import '../resources/css/app.css';


export const parameters = {
  actions: { argTypesRegex: "^on[A-Z].*" },
  controls: {
    matchers: {
      color: /(background|color)$/i,
      date: /Date$/,
    },
  },
}
export const decorators = [(story) => ({
	components: { story },
	template: '<div id="app"><story /></div>'
})];
