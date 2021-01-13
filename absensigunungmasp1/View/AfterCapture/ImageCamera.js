/* @flow weak */


import React, { Component } from 'react';
import {
  View,
  Text,
  Image,
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

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');
export default class MyComponent extends Component {

  render() {

    return (
        <View style={styles.CameraBox}>
        <Image style={styles.Image}
        source={{uri: 'https://billatowing.com/wp-content/uploads/2016/06/team-1.jpg'}}

          />
        <Text style={styles.TextBody}> Foto berhasil diambil</Text>
        </View>
    );
  }
}



const styles = StyleSheet.create({

  CameraBox:{
    width:WIDTH-30,
    height:566,
    backgroundColor:'rgba(132,196,255,0)',
    marginTop:20,
    borderRadius:20,
    alignItems: 'center',
    justifyContent: 'center'
  },
Image:{
  marginTop:20,
  width: WIDTH-40,
  height: 560,
  borderRadius:30,
  backgroundColor:'rgba(255,255,255,1)',

  },TextBody:{
    paddingTop:14,
    fontFamily:'Raleway-Regular',
    fontSize: 17,
    lineHeight: 20,
    color:'rgba(0,0,0,5)'
  }
});
