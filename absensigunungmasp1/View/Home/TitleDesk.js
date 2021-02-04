/* @flow weak */


import React, { Component,useState } from 'react';
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
import AsyncStorage from '@react-native-async-storage/async-storage';
import moment from 'moment-timezone';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';

  var IPSERVER ="---";

const storeDataJadwalJson = async (e) => {
  try {
    await AsyncStorage.setItem('Json_Jadwal', e);
  } catch (e) {
    Alert.alert(e);
  }
}
const storeJson = async (v,e) => {
  try {
    await AsyncStorage.setItem(v, e);
  } catch (e) {
    Alert.alert(e);
  }
}
const getData = async (e) => {
    try {
      const value = await AsyncStorage.getItem(e)
      if(value !== null) {
        console.log("Ip Server addresss--->");
        IPSERVER=value;
      }else {
        console.log("Ip Null");
      }
    } catch(e) {
      Alert.alert(e);
    }
  }


export default class MyComponent extends Component {
  constructor (props) {
    super(props)
    this.state = {
      Jarak:'',
      Pjarak:'',
      tanggal:'',

      Jmasuk:'',
        JmasukState:'',
      JmasukEnd:'',
        JmasukEndState:'',
      Toleransi:'',
        ToleransiState:'',

      Jpulang:'',
        JpulangState:'',

      JpulangEnd:'',
        JpulangEndState:'',

      jamNow:'',
      jamData:'',
      MasukState:'',
      PulangState:'',


    }
  }
  componentWillMount(){
    let Getlokas=()=>{

          Geolocation.getCurrentPosition(info =>{
                        var dis = getDistance(
                          {latitude: info.coords.latitude, longitude: info.coords.longitude},//kordinat sekarang
                          {latitude: this.state.JKordinat.la, longitude: this.state.JKordinat.lo},  //kordinat SET
                        );
                        this.setState({Jarak:dis});
                        var disP = getPreciseDistance(
                          {latitude: info.coords.latitude, longitude: info.coords.longitude},
                          {latitude: this.state.JKordinat.la, longitude: this.state.JKordinat.lo},

                        );
                        this.setState({Pjarak:disP});
            } );
      }

    const tanggalSekarang=()=>{
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
           var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
           var date = new Date();
           var month = date.getMonth();
           var day = date.getDate();
           var thisDay = date.getDay(),
               thisDay = myDays[thisDay];
           var yy = date.getYear();
           var year = (yy < 1000) ? yy + 1900 : yy;
          let   tgl=thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
            this.setState({TanggalNow: tgl});
    }

    const Formula_Jam=(e)=>{
//NOW------
     let now=moment().tz("Asia/Jakarta").format('HH:mm');
     this.setState({jamNow: JSON.stringify(now)});
     let H_now=0;
     let M_now=0;
     H_now=this.state.jamNow.split(":")[0];
     M_now=this.state.jamNow.split(":")[1];
//From Base------
           let Get_timefrombase =moment(e, 'hh:mm:ss', false).tz("Asia/Jakarta").format('HH:mm');
           this.setState({jamData: JSON.stringify(Get_timefrombase)});
           let H_Get=0;
           let M_Get=0;
           H_Get=this.state.jamData.split(":")[0];
           M_Get=this.state.jamData.split(":")[1];

           if (H_now <= H_Get) {
             if(H_now == H_Get){
               // console.log("Jam sama"+H_Get);
                 if (M_now < M_Get) return true;
                     else return false;
             }else{
               return true;
             }
           }
           else{
             return false;
           }

    }

    const Formula_Jadwal_masuk=()=>{
      let masuk=this.state.JmasukState;
      let masukEnd=this.state.JmasukEndState;
      let toler=this.state.ToleransiState;
      let val="Log";
            if(masuk){
                      val="Jam Absen Belum Masuk ";
                      this.setState({MasukState:{
                            pesan:val,
                            state: false
                        }});
            }else{
                    if(masukEnd){
                      val="Silahkan Ambil Absen Masuk Pada Jam Ini";
                      this.setState({MasukState:{
                            pesan:val,
                            state: true
                        }});

                    }else{
                            if(toler){
                              val="Terlambat";
                              this.setState({MasukState:{
                                    pesan:val,
                                    state: true
                                }});
                            }else{
                              val="Anda Masuk Diluar Jam Ketentuan";
                              this.setState({MasukState:{
                                    pesan:val,
                                    state: false
                                }});
                            }

                    }
            }

            Formula_Jadwal_Pulang();

    }

    const Formula_Jadwal_Pulang=()=>{
      let pulang=this.state.JpulangState;
      let pulangEnd=this.state.JpulangEndState;
      let val="Log";
            if(pulang){
                      val="Jam Absen Belum Pulang ";
                      this.setState({PulangState:{
                            pesan:val,
                            state: false
                        }});
            }else{
                    if(pulangEnd){
                      val="Silahkan Ambil Absen PULANG Pada Jam Ini";
                      this.setState({PulangState:{
                            pesan:val,
                            state: true
                        }});

                    }else{
                              val="Anda Pulang Diluar Jam Ketentuan";
                              this.setState({PulangState:{
                                    pesan:val,
                                    state: false
                                }});
                    }
            }
            // const jsonValuePulang = JSON.stringify(this.state.PulangState);
            // setTimeout(()=>storeJson('PulangState',jsonValue),0);
            const jsonValue = JSON.stringify({MasukState:this.state.MasukState,PulangState:this.state.PulangState});
            setTimeout(()=>storeJson('TombolState',jsonValue),0);
    }


    let GetDataFromDB=()=>{
        getDataLoginJson();
        fetch(IPSERVER+"/React-Native-GUNUNGMAS-ABSENS/webabsen/index.php/AuthApp/JadwalCek", {
            method: "POST",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json"
            },
            body: JSON.stringify({
              IDkaryawan:  this.state.user.IDkaryawan,
            })
          }).then(response => response.json()).then(responseJson => {
              if (responseJson.respond) {
                this.setState({jadwalJSON:responseJson.data});this.setState({Jsift:responseJson.data.ket_waktu});this.setState({Jlokasi:responseJson.data.lokasi});
                this.setState({JKordinat:{la:responseJson.data.latitude,lo:responseJson.data.longitude,}});tanggalSekarang();Getlokas();
                //---Masuk
                this.setState({Jmasuk:responseJson.data.waktu_mulai_masuk});
                    this.setState({JmasukState: Formula_Jam(responseJson.data.waktu_mulai_masuk)});
              //---Berakhirmasuk
                this.setState({JmasukEnd:responseJson.data.waktu_selesai_masuk});
                    this.setState({JmasukEndState: Formula_Jam(responseJson.data.waktu_selesai_masuk)});
              //---BatasTerlambat
                this.setState({Toleransi:responseJson.data.toleransi});
                    this.setState({ToleransiState: Formula_Jam(responseJson.data.toleransi)});

                this.setState({Jpulang:responseJson.data.waktu_mulai_keluar});
                    this.setState({JpulangState: Formula_Jam(responseJson.data.waktu_mulai_keluar)});

                this.setState({JpulangEnd:responseJson.data.waktu_selesai_keluar});
                    this.setState({JpulangEndState: Formula_Jam(responseJson.data.waktu_selesai_keluar)});
                // Formula_Jadwal_Pulang();
                const jsonValue = JSON.stringify(responseJson.data);
                setTimeout(()=>storeDataJadwalJson(jsonValue),0);
                Formula_Jadwal_masuk();

                }else{
                  console.log("Jadwal Anda Belum di SET");
                }
            }).catch(error => {
              console.log("Gagal cek jadwal !!!!")
              console.error(error);
              });

      }
    const getDataLoginJson = async () => {
      try {
          const jsonValue = await AsyncStorage.getItem('Json_Login');
           const data =JSON.parse(jsonValue);
           this.setState({user:data});
           // console.log(this.state.user);
           setTimeout(()=>{
           GetDataFromDB();

             },5000);
        } catch(e) {
          Alert.alert(e);
        }
      }

      setTimeout(()=>{
        console.log("Call-----");
        getDataLoginJson();
        getData('IPSERVER');
        },5000);
    }

  render() {

    return (
        <View>
        <TouchableOpacity   style={styles.SmallNotif} >
            <Text style={styles.TextSmallNotif}  >Masuk</Text>
        </TouchableOpacity>
          <Text  style={styles.TextTitle}>Absensi Hari Ini: &nbsp;
          </Text>

          <Text style={styles.TextBody}>{ this.state.TanggalNow }</Text>
          <Text style={styles.TextBody} >Jam Masuk   : {this.state.Jmasuk} s/d {this.state.JmasukEnd}</Text>
          <Text style={styles.TextBody}>Jam Pulang   : {this.state.Jpulang} - {this.state.JpulangEnd}</Text>
          <Text style={styles.TextTitle}>Lokasi Absensi : </Text>
          <Text style={styles.TextBody}>
          {this.state.Jlokasi}</Text>
          <Text style={styles.TextBody}>
          </Text>
          <Text style={styles.TextBody}>Jarak :{this.state.Jarak}  m lagi</Text>
          <Text style={styles.TextTitle}>Jam Sekarng : {this.state.jamNow}</Text>
          <Text style={styles.TextBody}>Kondisi Masuk &nbsp;&nbsp;&nbsp;: {this.state.MasukState.pesan}</Text>
          <Text style={styles.TextBody}>Kondisi Pulang&nbsp;&nbsp;&nbsp;: {this.state.PulangState.pesan}</Text>
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
    flexWrap:'wrap'
  },TextBody:{
    fontFamily:'Raleway-Light',
    fontSize: 15,
    lineHeight: 20,
    color:'rgba(0,0,0,5)'
  },TextSmallNotif:{
    fontFamily:'Raleway-Light',
    fontSize: 12,
    color:'rgba(255,255,255,1)',
    lineHeight: 10,
    textShadowOffset: {width: -1, height: 1},
            textShadowRadius: 5
  },SmallNotif:{
            position:'absolute',
            // borderWidth:1,
            // borderColor: 'red',
            borderRadius:10,
            backgroundColor:'rgba(0, 162, 117, 0.9)',
            shadowColor: "rgba(0,0,0,1)",
            shadowOffset: {
                width: 3,
                height: 10,
            },
            shadowOpacity: 1,
            shadowRadius: 8.30,
            elevation: 10,
            alignItems:'center',
            justifyContent:'center',
            padding:5,
            top:8,
            left:150,
            width:70,
            },
});
