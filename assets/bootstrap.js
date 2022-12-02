import { startStimulusApp } from '@symfony/stimulus-bridge';

// Registers Stimulus components from components.json and in the components/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// register any custom, 3rd party components here
// app.register('some_controller_name', SomeImportedController);
