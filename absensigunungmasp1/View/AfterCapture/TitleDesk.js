/* @flow weak */


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
/* @flow */


export default class MyComponent extends Component {

  render() {
    let testCall=()=>{
      console.log("Bisa..");
    }
    return (
        <View >
          <Text onPress={testCall} style={styles.TextTitle}>Foto Selfie Kamu</Text>
        </View>
    );
  }
}



const styles = StyleSheet.create({

  TextTitle:{
    fontFamily:'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color:'rgba(0,0,0,1)',
    marginTop:20
  },TextBody:{
    fontFamily:'Raleway',
    fontSize: 17,
    lineHeight: 20,
    color:'rgba(0,0,0,5)'
  },
});
