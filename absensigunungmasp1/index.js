/**
 * @format
 */

import {AppRegistry} from 'react-native';
import App from './App';
import Setup from './Setup';
import {name as appName} from './app.json';

AppRegistry.registerComponent(appName, () => Setup);
