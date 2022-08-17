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
  Button,
  Modal
} from 'react-native';
import User from '../../assets/icons/user';
import Svgicon from '../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import Camera from './Camera';
import UploadBox from './testUpload';
import DatePicker from 'react-native-datepicker';
import DateTimePicker from '@react-native-community/datetimepicker';
import DocumentPicker from 'react-native-document-picker';


import AsyncStorage from '@react-native-async-storage/async-storage';
import RNFetchBlob from 'rn-fetch-blob'; //Libarary Untuk mengirim File dengan API
import RNFS from  'react-native-fs';
var IPSERVER =null;

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');


export default class Sakit extends Component {
  constructor(props){
    var a=new Date();

  super(props)
  this.state = {
    date:a.toISOString().slice(0,10),
    user:'',
    jadwalJSON:'',
    LoadingState:true,
    LoadingUpload:false,


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
    if (this.state.LoadingState) {
      getDataLoginJson();

      }
}
componentDidUpdate(){
  console.log("ada perubahan");
  const getData = async (e) => {
    try {
      const value = await AsyncStorage.getItem(e)
      if(value !== null) {
        console.log("Ip Server addresss--->"+IPSERVER);
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
                                                    this.setState({jadwalJSON:responseJson.data});
                                                    this.setState({LoadingState:false});
                                                    }else{
                                                      console.log("Jadwal Anda Belum di SET");
                                                    }
                                                    }).catch(error => {
                                                      console.log("Gagal cek jadwal !!!!")
                                                      console.error(error);
                                                      });
                                                    }
        await GetDataFromDB();
        console.log("Data Sedang Reload - - ->");
    }


  }
}
InserttoSQL= async()=>{
  console.log('mulai  upload');
  console.log('mulai  cek session');

  console.log(this.state.user);
  // const data = new FormData();
  const locaLurl=IPSERVER+"/React-Native-GUNUNGMAS-ABSENS/webabsen/index.php/Triger/Absen/Sakit";
      let KirimBlob= async()=>{
        console.log("ID wan----->");
        console.log( this.state.user.IDkaryawan);
              await  RNFetchBlob.fetch('POST', locaLurl, {
                    Authorization: "Bearer access-token",
                    otherHeader: "foo",
                    'Content-Type': 'multipart/form-data',
                }, [
                    { name: 'Suratos', filename: this.state.DocName,  data: this.state.DocUri }, //PPOST FILE dengan "name" sebagai variabel utama
                    { name: 'ID', data: this.state.user.IDkaryawan },
                    { name: 'NamaKaryawan', data: this.state.user.namakaryawan },
                    { name: 'StatusAbsen', data: "Sakit" },
                    { name: 'id_jadwal', data: this.state.jadwalJSON.id_jadwal },
                  ]).then(response  => {
                     const r =JSON.parse(response.data);
                     console.log(response.data);
                    // if (r.Respond == true) {
                    //   console.log("Bisa");
                    //   this.setState({LoadingUpload:true})
                    //   setTimeout(()=>{
                    //     this.setState({LoadingUpload:!this.state.LoadingUpload})
                    //     this.props.navigation.navigate('Home');
                    //   }
                    //   ,5000);
                    //   console.log(r );
                    //
                    // }else{
                    //   console.log("Gagal");
                    //   console.log(r);
                    // }
                  }).catch((e) => {
                    console.log("Terjadi Eror");
                    console.log(e);
                  })
      }
      if (IPSERVER!=null) {
        console.log("Send Dokumen ----->");
          KirimBlob();
      }else{
        console.log("Failed send---!");
      }
}
  render() {
    const selectOneFile = async () => {
      try {
        const res = await DocumentPicker.pick({
          type: [DocumentPicker.types.pdf],

        });
        console.log(res);
        const filePath=Platform.OS === "android" ? res.uri : res.uri.replace("file://","")
        const EnCodFile=await RNFS.readFile(filePath,"base64")
        this.setState({DocUri:EnCodFile})
        console.log('URI : ' + res.fileCopyUri);
        console.log('Type : ' + res.type);
        this.setState({DocType:res.type})
        this.setState({DocName:res.name})
        console.log("Isi Semua Tentang Dok:" );
        // console.log(res);
      } catch (err) {
        if (DocumentPicker.isCancel(err)) {
          alert('Anda Belum mengambil Files');
        } else {
          alert('Unknown Error: ' + JSON.stringify(err));
          throw err;
        }
      }
    };
    return (
      <View style={styles.Backcontainer}>
        <View   style={styles.container}>
        <TouchableOpacity style={styles.backButton} onPress={() =>this.props.navigation.goBack()} >
          <Svgicon    name="Back" color="black" />
        </TouchableOpacity>
              <View style={styles.Title}>
                <Text onPress={() => Keyboard.dismiss()} style={styles.JudulBld}>Izin Sakit</Text>
              </View>

              <View  style={styles.FormBox}>

                    <View style={styles.Form}>
                        <Text style={styles.Label}>Tanggal Sekarang</Text>
                        <DatePicker
                          style={styles.FormInputDate}
                          date={this.state.date}
                          mode="date"
                          placeholder="select date"
                          format="YYYY-MM-DD"
                          minDate="2018-01-01"
                          disabled={true}
                          maxDate="2022-12-31"
                          confirmBtnText="Confirm"
                          cancelBtnText="Cancel"
                          customStyles={{

                           dateIcon: {
                             position: 'absolute',
                             left: 0,
                             top: 4,
                             marginLeft: 0,
                           },
                           dateInput: {
                             marginLeft: 36,
                             marginRight:240,
                             borderWidth:0,
                             top:0,

                           },
                           dateText:{
                             fontFamily:'Raleway-Medium',

                             fontSize:16,
                           }
                          }}
                          onDateChange={(date) => {this.setState({date: date})}}
                          />
                           <Text style={styles.NotofikasiInput}>
                       </Text>
                     </View>
                     <View style={styles.Form}>
                         <Text style={styles.Label}>Keterangan</Text>
                         <TextInput style={styles.FormInput}  placeholder="Tulis keterangan sakit mu disini "/>
                            <Text style={styles.NotofikasiInput}>
                        </Text>
                      </View>
                      <TouchableOpacity onPress={selectOneFile}>
                      <UploadBox filename={this.state.DocName} />
                      </TouchableOpacity>
                     <TouchableOpacity onPress={this.InserttoSQL}
                       style={styles.FormButton} >
                        <Text style={styles.FormButtonLable}>Kirim </Text>
                    </TouchableOpacity>
                    <TouchableOpacity
                      style={styles.FormButtonWhite} >
                       <Text style={styles.FormButtonLableChancel}>Batal</Text>
                   </TouchableOpacity>
              </View>


        </View>
        {
                            <Modal animationType = {"slide"} transparent = {true}
                          visible = {this.state.LoadingState}
                          onRequestClose = {() => { console.log("Modal has been closed.") } }>

                          <View style = {styles.modal}>
                             <Text style = {styles.labelmodal}>Load . . .</Text>

                          </View>
                       </Modal>
                     }
                     {
                                         <Modal animationType = {"slide"} transparent = {true}
                                       visible = {this.state.LoadingUpload}
                                       onRequestClose = {() => { console.log("Modal has been closed.") } }>

                                       <View style = {styles.modal}>
                                          <Text style = {styles.labelmodal}>Upload Foto . . .</Text>
                                       </View>
                                    </Modal>
                                  }
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
  FormButtonLableChancel:{
    fontFamily:'Raleway-Bold',
    fontSize:20,
    color:'#359EFF'
    },
    Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },backButton:{
      backgroundColor:'rgba(50,50,50,0)',
      borderRadius:50,
      top:-15,
      left:-15,
      width:70,
      height:70,
      alignItems:'center',
      justifyContent:'center',
    },
  Icon:{
    position: 'absolute',
    top:26,
    left:24
  },
  container: {
    top:20,
    width:WIDTH-30,
    // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer:{
    width:'100%',
    paddingBottom:20
    // backgroundColor:'grey'
  },
  Title:{
      width:'100%',
      alignItems:'center',
      top:139,
    },
    JudulBld:{
      fontFamily: 'Raleway-Bold',
      fontSize: 35,
      lineHeight: 35,
  },
  FormBox:{
    paddingTop:50,
    position:'absolute',
    // backgroundColor: 'rgba(50,50,50,0.5)',
    width:WIDTH-30,
    top:230,
    flex:1,
    flexDirection:'column'
  },
//
  Form:{
    flex:1,
    width:'100%',
    marginBottom:15,
  },Label:{
    fontFamily: 'Raleway-Medium',
    fontSize: 12,
    lineHeight: 11.74,
    paddingLeft:20,
    paddingBottom:5,
    color:'black',
    letterSpacing:1.3,
  },FormInput:{
    height:50,
    width:'100%',
    paddingLeft:20,
    borderColor: 'rgba(0,0,0,0.5)',
    borderRadius:50,
    fontFamily:'Raleway-Medium',
    fontSize:16,
    borderWidth:1,
    borderStyle:'solid'
  },FormInputDate:{
    height:50,
    width:'100%',
    paddingLeft:20,
    borderColor: 'rgba(0,0,0,0.0)',
    borderRadius:50,
    fontFamily:'Raleway-Medium',
    fontSize:16,
    borderWidth:1,
    borderStyle:'solid'
    },
  //
  FormButton:{
    height:50,
    width:'100%',
    backgroundColor: '#359EFF',
    borderRadius:50,
    alignItems:'center',
    justifyContent:'center',
    shadowColor: "rgba(0,0,0,0.25)",
    shadowOffset: {
        width: 3,
        height: 10,
    },
    shadowOpacity: 0.03,
    shadowRadius: 50,
    elevation: 2,
  },  FormButtonWhite:{
      height:50,
      marginTop:12,
      width:'100%',
      backgroundColor: '#FFFFFF',
      borderRadius:50,
      borderWidth:1,
      borderStyle:'solid',
      borderColor:'#359EFF',
      alignItems:'center',
      justifyContent:'center',

    },
  FormButtonLable:{
    fontFamily:'Raleway-Bold',
    fontSize:20,
    color:'rgba(255,255,255,1)'
  }


});
