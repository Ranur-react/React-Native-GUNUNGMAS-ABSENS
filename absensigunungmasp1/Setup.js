/* @flow */

import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
} from 'react-native';
import Login from './View/Login';
import Home from './View/Home';
import Capture from './View/Capture';
import Sakit from './View/Izinsakit';

export default class MyComponent extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Sakit />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
