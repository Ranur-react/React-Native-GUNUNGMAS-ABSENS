

import React, { Component,useState  } from 'react';
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

import { CommonActions } from '@react-navigation/native';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
//-----Conditions
import AsyncStorage from '@react-native-async-storage/async-storage';
import moment from 'moment-timezone';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';
  var IPSERVER =null;
const getData = async (e) => {
    try {
      const value = await AsyncStorage.getItem(e)
      if(value !== null) {
        // console.log("Ip Server addresss--->"+IPSERVER);
        IPSERVER=value;
      }else {
        console.log("Ip Null");
      }
    } catch(e) {
      Alert.alert(e);
    }
  }



// End----Compoonet KOndisition
let Menu=(props)=>{
    let code=[];
    let opasisi=1;
    let disable=false;
    const Navigation=props.props.props.navigation;
        let buttonactions=()=>{
          Navigation.navigate(props.Destinations);
        }
    if (props.status) {disable=false;opasisi="1";}else{disable=true;opasisi="0.5"}
    code.push(
      <TouchableOpacity disabled={disable} style={styles.menuCard} onPress={buttonactions}>
          <View style={styles.icon}>
          <Svgicon key={170} name={props.icon} color={props.color} opacity={opasisi} />
          <Text style={styles.labelIcon}>{props.label}</Text>
          </View>
      </TouchableOpacity >
      )
    return code;
}


 class MenuLoop extends Component {
   constructor (props) {
     super(props)
     this.state = {
       LoadingState:true,
       TanggalNow:'-',
       Jarak:'',
       Pjarak:'',
       tanggal:'',

       StatusPulang:'false',
       StatusMasuk:'false',
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
       MasukState:{
         pesan:'',
          state: false},
       PulangState:{
         pesan:'',
          state: false},


     }
     //--TimeScheduleConfigurasi
     const getDataLoginJson = async () => {
       try {
         const jsonValue = await AsyncStorage.getItem('Json_Login');
         const data =JSON.parse(jsonValue);
         this.setState({user:data});
         } catch(e) {
           Alert.alert(e);
         }
       }
       if (this.state.LoadingState) {
         getDataLoginJson();
         getData('IPSERVER');
         }else{
         }
   }

   componentDidUpdate(){
 // console.log("ada perubahan");
 const getData = async (e) => {
     try {
       const value = await AsyncStorage.getItem(e)
       if(value !== null) {
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

 getData('IPSERVER');
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
               const Formula_Jadwal_masuk=async()=>{
                 let masuk=this.state.JmasukState;
                 let masukEnd=this.state.JmasukEndState;
                 let toler=this.state.ToleransiState;
                 let val="Log";
                 if (this.state.StatusMasuk ) {
                   await Getlokas();
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
                                     val="Anda Masuk Diluar Jam Ketentuan";
                                     this.setState({MasukState:{
                                       pesan:val,
                                       state: false
                                       }});
                                     }

                                   }
                                 }
                 }else {
                   val="Anda Masuk Diluar Jam Ketentuan";
                   this.setState({MasukState:{
                     pesan:val,
                     state: false
                     }});
                 }


                               Formula_Jadwal_Pulang();

                             }


                             const Formula_Jadwal_Pulang= async()=>{
                               let pulang=this.state.JpulangState;
                               let pulangEnd=this.state.JpulangEndState;
                               let val="Log";
                               if (this.state.StatusPulang) {
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

                                       }

                                       let GetDataFromDB= async ()=>{
                                        fetch(IPSERVER+"/React-Native-GUNUNGMAS-ABSENS/webabsen/index.php/AuthApp/JadwalCek", {
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


                                                    let d=responseJson.data.status_kehadiran;
                                                    if ( d !=0 & d !=null ) {
                                                      if ( d == "m"  ) {
                                                        this.setState({StatusKehadiran:"Masuk" });
                                                        this.setState({StatusMasuk: false });
                                                        this.setState({StatusPulang: true });
                                                      }
                                                      else if ( d == "i"  ) {
                                                        this.setState({StatusKehadiran:"Izin Tidak Masuk" });
                                                        this.setState({StatusMasuk: false });
                                                        this.setState({StatusPulang: false });

                                                      }
                                                      else if ( d == "s"  ) {
                                                        this.setState({StatusKehadiran:"Sakit" });
                                                        this.setState({StatusMasuk: false });
                                                        this.setState({StatusPulang: false });

                                                      }else{
                                                        this.setState({StatusKehadiran:"Hadir" });
                                                        this.setState({StatusMasuk: true });
                                                        this.setState({StatusPulang: false });

                                                      }

                                                    }else{
                                                      this.setState({StatusKehadiran:"Alfa" });
                                                      this.setState({StatusMasuk: true });
                                                      this.setState({StatusPulang: false });

                                                    }
                                                    console.log("Status Tombol Masuk");
                                                    console.log(this.state.StatusMasuk);

                                                    Formula_Jadwal_masuk();

                                                   console.log("Kondisi Pulang");
                                                   console.log(this.state.PulangState);
                                                   this.setState({LoadingState:false});

                                                   }else{
                                                     this.setState({LoadingState:false});

                                                     console.log("Jadwal Anda Belum di SET");
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
   }
  render() {


        let code=[];
              const listOBJ ={
                99:{nama:'Absen Masuk',icon:'Enter',status: this.state.MasukState.state, color:'',dest:"Masuk"},
                100:{nama:'Absen Pulang',icon:'Exit',status: this.state.PulangState.state, color:'',dest:"Pulang"},
                101:{nama:'Surat Sakit',icon:'Sakit',status:true,color:'',dest:"Sakit"},
                102:{nama:'Surat Izin',icon:'Exit',status:false,color:''},
              };
              for (var key in listOBJ) {
                  if (listOBJ.hasOwnProperty(key)) {
                    code.push(
                      <View>
                        <Menu key={key}
                          props={this.props}
                          Destinations={listOBJ[key].dest}
                          icon={listOBJ[key].icon}
                          label={listOBJ[key].nama}
                          status={listOBJ[key].status}
                          klik={listOBJ[key].exex}  />
                      </View>
                      )
                  }
              }
  return code;

  }
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
