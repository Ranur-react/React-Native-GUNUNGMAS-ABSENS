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
  TouchableWithoutFeedback
} from 'react-native';
import SvgComponent from './../../assets/icons/show';
const {width:WIDTH} =Dimensions.get('window');
import AsyncStorage from '@react-native-async-storage/async-storage';
// const IPSERVER="http://192.168.18.21";
const IPSERVER="http://192.168.43.106";
const URI="/webabsen/index.php/AuthApp/Passwordcek";
const storeDataString = async (key,value) => {
  try {
    await AsyncStorage.setItem(key, value);
  } catch (e) {
    Alert.alert(e);
  }
}
  const storeDataJson = async (e) => {
    try {
      await AsyncStorage.setItem('Json_Login', e);
    } catch (e) {
      Alert.alert(e);
    }
  }


export default class Login extends Component {


  constructor(props){
    super(props);
    this.state={
        email:'',
        paswd:'',
        showPassword:true,
        mailNotifikasi:'',
        paswdNotifikasi:'',

      }
  }
  render() {


   let PasswordShowTougle=()=>{
     if(this.state.showPassword == true){
        this.setState({showPassword:false})
     }else{
       this.setState({showPassword:true})

     }

   };
let EmailInputTougle=()=>{
  if(this.state.email.includes("@")){
    this.setState({mailNotifikasi:""})
  }else{
    this.setState({mailNotifikasi:'Input format e-mail dengan benar'})

  }
}


let paswdInputTougle=()=>{
  setInterval(()=>{ this.setState({showPassword:true})
    },30000);
var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})"); //Angka , Simbol dan Huruf
var passw=  /^[A-Za-z]\w{7,14}$/;  //Angka dan Huruf
// alph=  /^[A-Za-z]+$/; //Angka kecil dan Besar
let a=this.state.paswd.length;
let pas=this.state.paswd;
      if(a >= 8){
        if(strongRegex.test(pas)){
          this.setState({paswdNotifikasi:"bisaa"})

        }else{
          this.setState({paswdNotifikasi:' Password harus terdiri dari symbol(*&^$@!&) dan Angka (9-0)'})
        }
      }else{
        this.setState({paswdNotifikasi:' Password Minimal 8 karakter'})
      }
}

let onPressLogin=()=>{
 InserttoSQL();
}
let InserttoSQL=()=>{
  storeDataString('IPSERVER',IPSERVER);
  fetch(IPSERVER+URI, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        username: this.state.email,
        password: this.state.paswd,
      })
    }).then(response => response.json()).then(responseJson => {
        console.log(responseJson);
        console.log(responseJson.status);
        if (responseJson.status) {
          const jsonValue = JSON.stringify(responseJson);
          setTimeout(()=>storeDataJson(jsonValue),1000);
          this.props.navigation.navigate('Home');
          // storeDataString('ID',responseJson.IDkaryawan);
          // storeDataString('NamaKaryawan',responseJson.namakaryawan);
          // storeDataString('username',this.state.email);
          // storeDataString('password',this.state.paswd);
          // storeDataString('level',responseJson.levelakses);
          // storeDataString('status',responseJson.status);
        }else{
          console.log("Gagal");
          this.setState({paswdNotifikasi:responseJson.pesan});
          this.setState({mailNotifikasi:'Pastikan kamu terdaftar'});

        }
      }).catch(error => {
        console.error(error);
      });
}
    return (
      <TouchableWithoutFeedback   onPress={() => Keyboard.dismiss()}>
          <View  style={styles.container}>
            <View style={styles.Title}>
              <Text onPress={() => Keyboard.dismiss()} style={styles.JudulBld}>Login dulu ya!</Text>
            </View>
            <View style={styles.FormBox}>
                   <View style={styles.Form}>
                       <Text style={styles.Label}>Username</Text>
                      <TextInput style={styles.FormInput} onBlur={EmailInputTougle} onChangeText={e=>this.setState({email:e})} value={this.state.email} placeholder="E-mail "/>
                      <Text style={styles.NotofikasiInput}>
                      {this.state.mailNotifikasi}
                      </Text>
                    </View>
                    <View style={styles.Form}>
                    <Text style={styles.Label}>Password</Text>

                       <TextInput style={styles.FormInput} onBlur={paswdInputTougle} onChangeText={e=>this.setState({paswd:e})} value={this.state.paswd} secureTextEntry={this.state.showPassword}  placeholder="Password"/>
                                   <TouchableOpacity onPress={PasswordShowTougle}  style={styles.FromImageIcon} >
                                      <SvgComponent />
                                   </TouchableOpacity>
                       <Text style={styles.NotofikasiInput}>
                       {this.state.paswdNotifikasi}
                       </Text>
                     </View>
                       <TouchableOpacity
                         style={styles.FormButton}
                         onPress={onPressLogin}>
                          <Text style={styles.FormButtonLable}>Login</Text>
                      </TouchableOpacity>
             </View>
          </View>
      </TouchableWithoutFeedback>
    );
  }
}







const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',

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
},FormBox:{
  position:'absolute',
  // backgroundColor: 'rgba(50,50,50,0.5)',
  width:WIDTH-55,
  top:230,
  flex:1,
  flexDirection:'column'
},Form:{
  flex:1,
  width:'100%',
  marginBottom:25,


}
,FormInput:{
  height:50,
  width:'100%',
  paddingLeft:20,
  borderColor: 'rgba(0,0,0,0.5)',
  borderRadius:50,
  fontFamily:'Raleway-Medium',
  fontSize:16,
  borderWidth:1,
  borderStyle:'solid'
},
FromImageIcon:{
  position:'absolute',
  padding:10,
  height:50,
  width:'13%',
  right:3,
  borderRadius:50,
  alignItems:'center',
  justifyContent:'center'


},
FormButton:{
  height:50,
  width:'100%',
  backgroundColor: '#359EFF',
  borderRadius:50,
  alignItems:'center',
  justifyContent:'center',
      shadowColor: 'rgba(46, 229, 157, 0.4)',
      shadowOpacity: 1.5,
shadowOffset : { width: 1, height: 13},
},FormButtonLable:{
  fontFamily:'Raleway-Bold',
  fontSize:20,
  color:'rgba(255,255,255,1)'
},NotofikasiInput:{
  color:'#FE4102',
  paddingLeft:20
},Label:{
  fontFamily: 'Raleway-Medium',
  fontSize: 10,
  lineHeight: 11.74,
  paddingLeft:20,
  paddingBottom:5,
  fontWeight:"400",
  color:'black',
  letterSpacing:1.3,
}



});
