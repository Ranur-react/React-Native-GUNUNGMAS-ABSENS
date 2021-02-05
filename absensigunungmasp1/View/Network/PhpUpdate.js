/* @flow */

import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
} from 'react-native';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';
const IPSERVER="http://192.168.18.13";

export default class MyComponent extends Component {
  constructor (props) {
    super(props);
    // props.preventDefault();
    this.state = {
      Jam:'',
  }
  console.log("New State");

}
componentDidUpdate(){
}
  render() {
    // console.log("New State");


    let InserttoSQL=()=>{
      fetch(IPSERVER+"/React-Native-GUNUNGMAS-ABSENS/webabsen/index.php/AuthApp/JadwalCek", {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            IDkaryawan:  'K004',

          })
        }).then(response => response.json()).then(responseJson => {
            // console.log(responseJson);
            if (responseJson.respond) {
              this.setState({Jam:responseJson.data.waktu_mulai_masuk});
            }else{
              console.log("Gagal");

            }
          }).catch(error => {
            console.error(error);
          });
    }
    // InserttoSQL();
    return (
      <View style={styles.container}>
      <Text>Update terbaru Jam Hari Ini : {this.state.Jam}</Text>
        <Text></Text>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
