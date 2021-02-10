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
import AsyncStorage from '@react-native-async-storage/async-storage';
import User from './../../../assets/icons/user';
import Svgicon from './../../../assets/icons/Svgicon';
/* @flow */
const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');
export default class MyComponent extends Component {
  constructor (props) {
    super(props);
    this.state = {
      Foto:'null',
      Time: this.props.ShootTime
    }
  }
  render() {
const getData = async () => {
    try {
      const value = await AsyncStorage.getItem('Ft')
      if(value !== null) {
        this.setState({Foto:value})
      }else {
        this.setState({Foto:"https://billatowing.com/wp-content/uploads/2016/06/team-1.jpg"})
      }
    } catch(e) {
      Alert.alert(e);
    }
  }
    return (
        <TouchableOpacity onLayout={getData} style={styles.CameraBox}>
        <Image style={styles.Image}
        source={{uri: this.state.Foto}}

          />
        <Text style={styles.TextBody}> Foto Jam {this.state.Time} berhasil diambil</Text>
        </TouchableOpacity>
    );
  }
}



const styles = StyleSheet.create({

  CameraBox:{
    width:WIDTH-30,
    height:HEIGHT-(0.45*HEIGHT),
    backgroundColor:'rgba(132,196,255,0)',
    marginTop:20,
    borderRadius:20,
    alignItems: 'center',
    justifyContent: 'center'
  },
Image:{
  marginTop:20,
  width: WIDTH-40,
  height: HEIGHT-(0.5*HEIGHT),
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
