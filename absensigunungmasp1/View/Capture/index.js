/* @flow */

import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
  Dimensions,
  TextInput,
  Alert,
  TouchableOpacity,
  Svg,
  Keyboard,
  TouchableWithoutFeedback,
  ScrollView,
  Button
} from 'react-native';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import Camera from './Camera';

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');
export default class MyComponent extends Component {
  render() {
    return (
      <View style={styles.Backcontainer}>
        <View  style={styles.container}>
        <View  style={styles.Textcontainer}>
            <Svgicon  name="Back" color="black" />
            <Deskripsiabsen />
             <Camera />
          </View>
        </View>
        </View>
    );
  }
}

const styles = StyleSheet.create({
  Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },
  container: {
    top:20,
    width:WIDTH-30,
    alignItems:'flex-start',
    // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer:{
    width:'100%',
    paddingBottom:20
    // backgroundColor:'grey'
  }
});
