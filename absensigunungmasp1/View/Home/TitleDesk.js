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
  TouchableHighlight,
  Svg,
  Keyboard,
  TouchableWithoutFeedback,
  ScrollView,
  Button,
  Modal,
  Image

} from 'react-native';
import PulseLoader from 'react-native-pulse-loader';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
import {APISERVER} from './../../assets/constant/';


/* @flow */
import AsyncStorage from '@react-native-async-storage/async-storage';
import moment from 'moment-timezone';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';
  var IPSERVER =null;


export default class MyComponent extends Component {
  constructor (props) {
    super(props)
    this.state = {
      Notifikasi:{
          state:false,
          pesan:''
        },
      LoadingState:true,
      TanggalNow:'-',
      Jarak:'',
      Range:'',
      Pjarak:'',
      tanggal:'',

      JSift:'',
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
      StatusKehadiran:'',


    }
    const getDataLoginJson = async () => {
      try {
        const jsonValue = await AsyncStorage.getItem('Json_Login');
        const data =JSON.parse(jsonValue);
        this.setState({user:data});
        } catch(e) {
          Alert.alert(e);
        }
      }
        getDataLoginJson();

    //--TimeScheduleConfigurasi

  }

  componentDidUpdate(){
// console.log("ada perubahan");
const getData = async (e) => {
    try {
      const value = await AsyncStorage.getItem(e)
      if(value !== null) {
        // console.log("Ip Server addresss--->"+IPSERVER);
        IPSERVER=value;
        if (IPSERVER != null) {
            Call()
        }else{
          console.log("Ip Server ASYN: ");
          console.log(IPSERVER);
          console.log("Loading......");
        }

      }else {
        console.log("Ip Null");
      }
    } catch(e) {
      Alert.alert(e);
    }
  }
const Call=async()=>{

  if (this.state.LoadingState) {



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
        this.setState({TanggalNow:tgl});
      }
      let Getlokas=  async ()=>{

        await Geolocation.getCurrentPosition(info =>{
          var dis = getDistance(
            {latitude: info.coords.latitude, longitude: info.coords.longitude},//kordinat sekarang
            {latitude: this.state.JKordinat.la, longitude: this.state.JKordinat.lo},  //kordinat SET
            );
            this.setState({Jarak:dis});
            this.setState({la:info.coords.latitude,lo:info.coords.longitude});
            var disP = getPreciseDistance(
              {latitude: info.coords.latitude, longitude: info.coords.longitude},
              {latitude: this.state.JKordinat.la, longitude: this.state.JKordinat.lo},

              );
              this.setState({Pjarak:disP});
              } );
            }
            const Formula_Jam= (e)=>{
              //NOW------
              let now=moment().tz("Asia/Jakarta").format('HH:mm:ss');
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
              const Formula_Jadwal_masuk=async()=>{
                let masuk=this.state.JmasukState;
                let masukEnd=this.state.JmasukEndState;
                let toler=this.state.ToleransiState;
                let val="Log";
                Getlokas();

                if(masuk){
                  val="Jam Absen Belum Masuk ";
                  this.setState({MasukState:{
                    pesan:val,
                    state: false
                    }});
                    }else{
                      if(masukEnd){
                              if (this.state.Jarak < this.state.Range) {
                                val="Silahkan Ambil Absen Masuk Pada Jam Ini";
                                this.setState({MasukState:{
                                  pesan:val,
                                  state: true
                                  }});
                              }else{
                                val="Segera Menuju Kantor untuk mengaktifkan Tombol Masuk,Jangan sampe Terlambat";
                                this.setState({MasukState:{
                                  pesan:val,
                                  state: false
                                  }});
                              }
                          }else{
                            if(toler){
                              console.log("Pjarak");
                              console.log(this.state.Jarak);
                                    if (this.state.Jarak < this.state.Range) {
                                      val="Terlambat";
                                      this.setState({MasukState:{
                                        pesan:val,
                                        state: true
                                        }});
                                    }else{
                                      val="Segera Menuju Kantor untuk mengaktifkan Tombol Masuk,Anda Terlambat Gak ada waktu lagi.. cepetan!!!";
                                      this.setState({MasukState:{
                                        pesan:val,
                                        state: false
                                        }});
                                    }

                                }else{
                                  val="Jam Masuk Diluar Jam Ketentuan";
                                  this.setState({MasukState:{
                                    pesan:val,
                                    state: false
                                    }});
                                  }

                                }
                              }

                              Formula_Jadwal_Pulang();

                            }
                            const Formula_Jadwal_Pulang= async()=>{
                              let pulang=this.state.JpulangState;
                              let pulangEnd=this.state.JpulangEndState;
                              let val="Log";
                                Getlokas();
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

                                      }
                                      let GetDataFromDB= async ()=>{
                                       fetch(APISERVER+"/webabsen/index.php/AuthApp/JadwalCek", {
                                          method: "POST",
                                          headers: {
                                            Accept: "application/json",
                                            "Content-Type": "application/json",
                                            'Cache-Control': 'no-cache'
                                            },
                                            body: JSON.stringify({
                                              IDkaryawan:  this.state.user.IDkaryawan,
                                              })
                                              }).then(response => response.json()).then(responseJson => {
                                                if (responseJson.respond) {
                                                  this.setState({jadwalJSON:responseJson.data});this.setState({Jsift:responseJson.data.ket_waktu});this.setState({Jlokasi:responseJson.data.lokasi});
                                                  this.setState({JKordinat:{la:responseJson.data.latitude,lo:responseJson.data.longitude,}});
                                                  this.setState({Range:responseJson.data.range});
                                                   tanggalSekarang();
                                                  //---Masuk
                                                  this.setState({Jmasuk:responseJson.data.waktu_mulai_masuk});
                                                  //---Berakhirmasuk
                                                  this.setState({JmasukEnd:responseJson.data.waktu_selesai_masuk});
                                                  //---BatasTerlambat
                                                  this.setState({Toleransi:responseJson.data.toleransi});

                                                  this.setState({Jpulang:responseJson.data.waktu_mulai_keluar});

                                                  this.setState({JpulangEnd:responseJson.data.waktu_selesai_keluar});

                                                  this.setState({JmasukEndState: Formula_Jam(responseJson.data.waktu_selesai_masuk)});
                                                  this.setState({ToleransiState: Formula_Jam(responseJson.data.toleransi)});
                                                  this.setState({JpulangState: Formula_Jam(responseJson.data.waktu_mulai_keluar)});
                                                  this.setState({JpulangEndState: Formula_Jam(responseJson.data.waktu_selesai_keluar)});
                                                  this.setState({JmasukState: Formula_Jam(responseJson.data.waktu_mulai_masuk)});
                                                   Formula_Jadwal_masuk();

                                                   let d=responseJson.data.status_kehadiran;
                                                   if ( d !=0 & d !=null ) {
                                                     if ( d == "m"  ) {
                                                       this.setState({StatusKehadiran:"Masuk (Belum Pulang)" });
                                                     }
                                                     else if ( d == "i"  ) {
                                                       this.setState({StatusKehadiran:"Izin Tidak Masuk" });
                                                     }
                                                     else if ( d == "s"  ) {
                                                       this.setState({StatusKehadiran:"Sakit" });

                                                     }else{
                                                       this.setState({StatusKehadiran:"Hadir (Sudah Pulang)" });

                                                     }

                                                   }else{
                                                     this.setState({StatusKehadiran:"Alfa" });

                                                   }
                                                  console.log("Kondisi Pulang");
                                                  console.log(this.state.PulangState);
                                                  this.setState({LoadingState:false});

                                                  }else{

                                                    console.log("Jadwal Anda Belum di SET");
                                                    this.setState({LoadingState:false});

                                                    this.setState({Notifikasi:{state:true,pesan:responseJson.Pesan}});

                                                  }
                                                  }).catch(error => {
                                                    console.log("Gagal cek jadwal !!!!")
                                                    console.error(error);
                                                    });
                                                  }
      GetDataFromDB();
      console.log("Data Sedang Reload - - ->");
  }

}
getData('IPSERVER');

  }

  render() {

    return (

        <View onLayout={this.newStateFun}>

          <Text   style={styles.TextTitle}>Absensi Hari Ini: &nbsp;
          </Text>

          <Text style={styles.TextBody}>{this.state.TanggalNow }</Text>
          <Text style={styles.TextBody} >Jam Masuk   : {this.state.Jmasuk} s/d {this.state.JmasukEnd}</Text>
          <Text style={styles.TextBody}>Jam Pulang   : {this.state.Jpulang} - {this.state.JpulangEnd}</Text>
          <Text style={styles.TextTitle}>Lokasi Absensi : </Text>
          <Text style={styles.TextBody}>
          {this.state.Jlokasi}</Text>
          <Text style={styles.TextBody}>Range :{this.state.Range}  m di dalam lokasi</Text>
          <Text style={styles.TextBody}>Jarak :{this.state.Jarak}  m  lagi ke lokasi</Text>
          <Text style={styles.TextBody}>
          </Text>
          <Text style={styles.TextTitle}>Jam Sekarng : {this.state.jamNow}</Text>
          <Text style={styles.TextBody}>Kondisi Masuk &nbsp;&nbsp;&nbsp;: {this.state.MasukState.pesan}</Text>
          <Text style={styles.TextBody}>Kondisi Pulang&nbsp;&nbsp;&nbsp;: {this.state.PulangState.pesan}</Text>
          <Text style={styles.TextBody}>Status Kehadiran &nbsp;&nbsp;&nbsp;: {this.state.StatusKehadiran}</Text>
          <View>
{
                    <Modal animationType = {"slide"} transparent = {true}
                  visible = {this.state.LoadingState}
                  onRequestClose = {() => { console.log("Modal has been closed.") } }>

                  <View style = {styles.modal}>
                  <View style={{position:'absolute'}}>

                  </View>
                     <Text style = {styles.labelmodal}>Load . . .</Text>
                     <Image
     source={{uri: 'https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/45a2a353042777.5925c70c0cb86.gif'}}
     style={{width: 100, height:100 }}
 />
                     <TouchableHighlight onPress = {() => {this.setState({LoadingState:!this.state.LoadingState})}}>

                        <Text style = {styles.labelmodal}>X</Text>
                     </TouchableHighlight>
                  </View>
               </Modal>
             }
             {
                                 <Modal animationType = {"slide"} transparent = {false}
                               visible = {this.state.Notifikasi.state}
                               onRequestClose = {() => { console.log("Modal has been closed.") } }>

                               <View style = {styles.modalEror}>
                               <View style={{position:'absolute'}}>

                               </View>
                                  <Text style = {styles.labelmodalEror}>{this.state.Notifikasi.pesan}</Text>
                                  <Image
                  source={{uri: 'https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/45a2a353042777.5925c70c0cb86.gif'}}
                  style={{width: 100, height:100 }}
              />
                                  <TouchableHighlight onPress = {() => {this.setState({LoadingState:!this.state.LoadingState})}}>

                                     <Text style = {styles.labelmodal}>X</Text>
                                  </TouchableHighlight>
                               </View>
                            </Modal>
                          }
          </View>
          <TouchableOpacity onPress={()=>console.log("tesss")}  style={styles.SmallNotif} >
              <Text style={styles.TextSmallNotif}  >Masuk</Text>
          </TouchableOpacity  >
        </View>
    );
  }
}



const styles = StyleSheet.create({
  modal: {
      flex: 1,
      alignItems: 'center',
      justifyContent:'center',
      backgroundColor: 'rgba(76,169,255,0.6)',
      padding: 100
   },  labelmodal:{
       textAlign:'center',
       fontFamily:'Raleway-Bold',
       fontSize: 20,
       color:'rgba(255,255,255,1)'
     },
     modalEror: {
         flex: 1,
         alignItems: 'center',
         justifyContent:'center',
         backgroundColor: 'rgba(255,255,255,1)',
         padding: 100
      },  labelmodalEror:{
          textAlign:'center',
          fontFamily:'Raleway-Bold',
          fontSize: 20,
        color:'rgba(0,0,0,1)',
        },
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
