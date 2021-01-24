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
//library
import {launchCamera, launchImageLibrary} from 'react-native-image-picker';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';

//asset
import Svgicon from './../../assets/icons/Svgicon';
import User from './../../assets/icons/user';
//end-asset

//Class/Funt-extends
import Deskripsiabsen from './TitleDesk';
import Camera from './Camera';
//end-class

//var/data declarated
const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');


const storeDataString = async (key,value) => {
  try {
    await AsyncStorage.setItem(key, value);
  } catch (e) {
    Alert.alert(e);
  }
}
const storeDataJson = async (value) => {
  try {
    await AsyncStorage.setItem('Json_Storage', value);
  } catch (e) {
    Alert.alert(e);
  }
}



let lokasibaca=()=>{
console.log("Cetak Lokasi");
Geolocation.getCurrentPosition(info =>{
              console.log(info.coords)
              var dis = getDistance(
                {latitude: info.coords.latitude, longitude: info.coords.longitude},
                {latitude: -0.9119737374720464, longitude:   100.36146126462073},

              );

              console.log("Jarak: ");
              console.log(dis);
              console.log("Meter");


              var dis = getPreciseDistance(
                {latitude: info.coords.latitude, longitude: info.coords.longitude},
                {latitude: -0.9119737374720464, longitude:   100.36146126462073},
              );

              console.log("Presisi Jarak: ");
              console.log(dis);
              console.log("Meter");
  } );


}


export default class MyComponent extends Component {
  constructor(props) {
    super(props);
  }
  // componentDidMount() {
  //   if(hasLocationPermission) {
  //     Geolocation.getCurrentPosition(
  //         (position) => {
  //           console.log(position);
  //         },
  //         (error) => {
  //           // See error code charts below.
  //           console.log(error.code, error.message);
  //         },
  //         { enableHighAccuracy: true, timeout: 15000, maximumAge: 10000 }
  //     );
  //   }
  // }
  selectFile = () => {
    var options = {
      mediaType: 'photo',
      maxWidth:1000,
      maxHeight:1000,
      saveToPhotos:true,
      includeBase64:true
    };
  launchCamera(options, res => {
      if (!res.didCancel){
        storeDataString('Ft',res.uri);
        const jsonValue = JSON.stringify(res);
        storeDataJson(jsonValue);
        this.props.navigation.navigate('AfterCapture');
      }
    });
  };

  render() {
    lokasibaca();
    return (
      <View  style={styles.Backcontainer}>
        <View  style={styles.container}>
        <View  style={styles.Textcontainer}>
            <TouchableOpacity style={styles.backButton} onPress={() =>this.props.navigation.goBack()} >
              <Svgicon name="Back" color="black" />
            </TouchableOpacity>
            <Deskripsiabsen />
            <TouchableOpacity onPress={this.selectFile}>
              <Camera />
            </TouchableOpacity>
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
  backButton:{
    backgroundColor:'rgba(50,50,50,0)',
    borderRadius:50,
    top:-15,
    left:-15,
    width:70,
    height:70,
    alignItems:'center',
    justifyContent:'center',
  }
  ,
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
