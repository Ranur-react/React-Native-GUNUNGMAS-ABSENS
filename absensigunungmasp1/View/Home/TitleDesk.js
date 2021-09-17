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
          <Text onPress={testCall} style={styles.TextTitle}>Absensi Hari Ini:</Text>
          <Text style={styles.TextBody}>Sabtu,07 November 2020</Text>
          <Text style={styles.TextBody}>Jam Masuk: 08.00 - 09.00</Text>
          <Text style={styles.TextBody}>Jam Pulang: 16.00 - 20.00</Text>
          <Text style={styles.TextTitle}>Lokasi Absensi: </Text>
          <Text style={styles.TextBody}>
          Jl.Adinegoro No.9,</Text>
          <Text style={styles.TextBody}>Tabing,Kec.Koto Tangah,Kota Padang</Text>
        </View>
    );
  }
}



const styles = StyleSheet.create({

  TextTitle:{
    fontFamily:'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color:'rgba(0,0,0,1)'
  },TextBody:{
    fontFamily:'Raleway',
    fontSize: 15,
    lineHeight: 20,
    color:'rgba(0,0,0,5)'
  },
});
