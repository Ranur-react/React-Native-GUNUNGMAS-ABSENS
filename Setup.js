/* @flow */

import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
} from 'react-native';

import Navigasi from './View/Navigasi';

export default class MyComponent extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Navigasi />
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
