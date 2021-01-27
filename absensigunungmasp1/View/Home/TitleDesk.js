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

import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';



export default class MyComponent extends Component {
  constructor (props) {
    super(props)
    this.state = {
      Jarak:'',
      Pjarak:'',
    }
  }
  render() {
    let testCall=()=>{
      console.log("Bisa..");
    }
    setTimeout(()=>{

          Geolocation.getCurrentPosition(info =>{
                        // console.log(info.coords)
                        var dis = getDistance(
                          {latitude: info.coords.latitude, longitude: info.coords.longitude},
                          {latitude: -0.9111009079655364, longitude: 100.36126595880887},
                        );
                        this.setState({Jarak:dis});
                        var disP = getPreciseDistance(
                          {latitude: info.coords.latitude, longitude: info.coords.longitude},
                          {latitude: -0.9119737374720464, longitude:   100.36146126462073},
                        );
                        this.setState({Pjarak:disP});
            } );
      // console.log(this.state.Jarak);
      },5000);
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
          <Text style={styles.TextBody}>Jarak kamu dari Lokasi : <Text style={styles.TextTitle}> {this.state.Jarak} m</Text> </Text>
          <Text style={styles.TextBody}>Presisi Jarak kamu dari Lokasi : <Text style={styles.TextTitle}> {this.state.Pjarak} m</Text></Text>
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
