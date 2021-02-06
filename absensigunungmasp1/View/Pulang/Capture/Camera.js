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
  Button,
} from 'react-native';
import User from './../../../assets/icons/user';
import Svgicon from './../../../assets/icons/Svgicon';


const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');


export default class MyComponent extends Component {

  render() {
    const Default=()=>{
      let Output=[];
          Output.push(
            <View style={styles.CameraBox}>
            <Svgicon  name="Camera" color="black" />
            <Text style={styles.TextTitleWhite}>Ambil Foto
            </Text>
            </View>
            );

      return Output;
    }
    return (<Default />);
  }
}



const styles = StyleSheet.create({

  CameraBox:{
    width:WIDTH-30,
    height:566,
    backgroundColor:'rgba(132,196,255,1)',
    borderRadius:20,
    marginTop:20,
    alignItems: 'center',
    justifyContent: 'center'
  },

  TextTitleWhite:{
    fontFamily:'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color:'rgba(255,255,255,1)',
    lineHeight: 23,

  }
});
