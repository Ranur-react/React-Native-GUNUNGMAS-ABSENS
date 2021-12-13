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
  Image
} from 'react-native';
import { APIDOMAINWEB } from '../../assets/containt';
import { showToastWithGravityAndOffset } from '../../assets/_Toasview'
import AsyncStorage from '@react-native-async-storage/async-storage';


import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';

class ClassHIstory extends Component {
  constructor(props) {
    super(props)
    this.state = {
      Sourcelink: {
        link1: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80',
        link2: ''
      }
    }
  }
  UNSAFE_componentWillMount() {
    let GetDataFromDB = async () => {
      fetch(APIDOMAINWEB + "/AuthApp/histoMasuk", {
        method: "POST",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          'Cache-Control': 'no-cache'
        },
        body: JSON.stringify({
          IDkaryawan: this.state.user.IDkaryawan,
        })
      }).then(response => response.json()).then(responseJson => {
        console.log("=========Data Masuk==========");
        console.log(responseJson);
        console.log("========================");
        this.setState({ datamasuk: responseJson.data })
        console.log(this.state.datamasuk);
        showToastWithGravityAndOffset("History Masuk Di Dapatkan")
      }).catch(error => {
        console.log("Gagal cek jadwal !!!!")
        console.error(error);
      });
    }
    const getDataLoginJson = async () => {
      try {
        const jsonValue = await AsyncStorage.getItem('Json_Login');
        const data = JSON.parse(jsonValue);
        this.setState({ user: data });
        console.log(!data.status);
        if (this.state.user) {
          console.log("Ada  User History ");
          GetDataFromDB()
        }
        showToastWithGravityAndOffset("data user didapatkan")
      } catch (e) {
        showToastWithGravityAndOffset(e.toString())
      }
    }
    getDataLoginJson();
  }
  render() {
    console.log("Data History Absen - - - -");
    if (!this.state.datamasuk) {
      return (
        <View>
          <TouchableOpacity style={styles.HistoryCard}>
            <Image style={styles.ImageCapture} source={{ uri: this.state.Sourcelink.link1 }} />
            <Text style={styles.Title}> Absensi  Masuk </Text>
            <Text style={styles.label}> 06 November 2020 </Text>
            <Text style={styles.label}> 08.33 </Text>
          </TouchableOpacity >
        </View>
      )
    } else {
      return (
        <View>
           {
         
         this.state.datamasuk.map((value, i) => {
          return (
            <View key={i}>
              <TouchableOpacity style={styles.HistoryCard}>
                <Image style={styles.ImageCapture} source={{ uri: value.foto_masuk }} />
                <View style={{
                  display:'flex',
                  flexDirection:'column'
                }}>
                <Text style={styles.Title}> Berhasil  Masuk </Text>
                <Text style={styles.label}> Tanggal  : {value.tanggal_masuk} </Text>
                <Text style={styles.label}> Jam Masuk : {value.jam_masuk} </Text>
                <Text style={styles.label}> Lokasi  :{value.lokasi} </Text>
                <Text style={styles.label}> Jenis Sift :{value.ket_waktu} </Text>
                </View>
              </TouchableOpacity >
            </View>
          )
  
        })
      


       }
        </View>
      )


    }
  }
}




  export default ClassHIstory;

  const styles = StyleSheet.create({
    HistoryCard: {
      backgroundColor: 'rgba(92,177,255,1)',
      width: 370,
      height: 200,
      // margin:20,
      marginBottom: 10,
      padding: 15.5,
      borderRadius: 20,
      shadowColor: "rgba(0,0,0,0.05)",
      shadowOffset: {
        width: 0.1,
        height: 0.1,
      },
      shadowOpacity: 0,
      shadowRadius: 1.30,
      elevation: 1,
      justifyContent: 'flex-start',
      alignItems: 'flex-start',
      textAlign: 'center',
      flexDirection: 'column',
      flexWrap: 'wrap',
    },
    ImageCapture: {
      height: 60,
      width: 60,
      borderRadius: 10,
      marginRight: 16
    },

    Title: {
      textAlign: 'center',
      fontFamily: 'Raleway-Bold',
      fontSize: 18,
      color: 'rgba(255,255,255,1)'
    }, label: {
      textAlign: 'center',
      fontFamily: 'Raleway',
      fontSize: 13,
      fontWeight: '500',
      color: 'rgba(255,255,255,1)'
    }

  });
