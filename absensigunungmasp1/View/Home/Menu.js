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

let Menu=(props)=>{
  let code=[];
  code.push(
    <TouchableOpacity style={styles.menuCard}>
        <View style={styles.icon}>
        <Svgicon name={props.icon} color={props.color} />
        <Text style={styles.labelIcon}>{props.label}</Text>
        </View>
    </TouchableOpacity >
    )
  return code;
}

let MenuLoop=(props)=>{
  let    cek=[
          'Absen Masuk',
          'Absen Pulang',
          'Surat Sakit',
          'Surat Izin'
          ];
  let code=[];
    for (var i = 0; i < cek.length; i++) {
        code.push(
          <View>
            <Menu icon='Enter' color='#f18f01' label={cek[i]} />
          </View>
          )
    }
    return code;
}

export default MenuLoop;

const styles = StyleSheet.create({
  menuCard:{
    backgroundColor:'rgba(76,169,255,1)',
    width:120,
    height:120,
    margin:20,
    padding:20,
    borderRadius:20,
    shadowColor: "rgba(0,0,0,0.15)",
    shadowOffset: {
      	width: 3,
      	height: 10,
    },
    shadowOpacity: 0.39,
    shadowRadius: 8.30,
    elevation: 10,
    justifyContent: 'flex-start',
    alignItems:'center',
    textAlign:'center'
  },
  icon:{
    width:50,
    height:50,
  },
  labelIcon:{
    textAlign:'center',
    fontFamily:'Raleway-Bold',
    fontSize: 12,
    color:'rgba(255,255,255,1)'
  }

});
